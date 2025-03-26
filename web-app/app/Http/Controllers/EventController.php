<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventController extends Controller
{

	public $current;
	protected $dates = ['startDate'];
	public static function getAll()
	{
		return Event::select('id', 'name', 'description', 'startDate', 'endDate', 'created_at')
			->orderBy('startDate', 'desc')
			->get();
	}

	public static function getCurrent()
	{
		$currentEvent = Event::where('startDate', '<', now())
			->where('endDate', '>', now())
			->first();

		if (!$currentEvent) {
			return null;
		}

		return [
			'id' => $currentEvent->id,
			'name' => $currentEvent->name,
			'startDate' => $currentEvent->startDate,
			'endDate' => $currentEvent->endDate,
			'description' => $currentEvent->description,
			'stats' => (new EventController())->getAllStatistics($currentEvent->id)
		];
	}

	public static function getNext()
	{
		$nextEvent = Event::where('startDate', '>', now())
			->orderBy('startDate', 'asc')
			->first();

		if (!$nextEvent) {
			return null;
		}

		return [
			'id' => $nextEvent->id,
			'name' => $nextEvent->name,
			'startDate' => $nextEvent->startDate,
			'endDate' => $nextEvent->endDate,
			'description' => $nextEvent->description
		];
	}

	public function store(Request $request)
	{
		if (!Auth::check()) {
			return redirect()->route('homepage');
		}

		$validated = $request->validate([
			'name' => 'required|string|max:50',
			'startDate' => 'required|date',
			'endDate' => 'required|date|after_or_equal:startDate',
			'description' => 'nullable|string|max:500',
			'tasks' => 'nullable|string',
		]);

		$startDate = Carbon::parse($validated['startDate'])->startOfDay();
		$endDate = Carbon::parse($validated['endDate'])->endOfDay();

		$event = new Event();
		$event->name = $validated['name'];
		$event->startDate = $startDate;
		$event->endDate = $endDate;
		$event->description = $validated['description'] ?? null;
		$event->created_at = now();

		if ($event->save()) {
			$eventID = $event->id;

			if (!empty($validated['tasks'])) {
				$taskIds = explode(",", $validated['tasks']);
				foreach ($taskIds as $taskID) {
					DB::table('eventconditions')->insert([
						'eventID' => $eventID,
						'conditiontypeID' => (int) trim($taskID),
						'quantity' => null,
						'created_at' => now(),
						'updated_at' => null,
					]);
				}
			}
			return redirect()->route('dashboard')->with('success', 'Challenge ajouté avec succès !');
		} else {
			return redirect()->back()->with('error', 'Une erreur est survenue, veuillez réessayer.');
		}
	}

	public function update(Request $request, $id)
	{
		$event = Event::find($id);

		if (!$event) {
			return response()->json(['success' => false, 'message' => 'Événement introuvable.']);
		}

		$validated = $request->validate([
			'name' => 'required|string|max:50',
			'startDate' => 'required|date',
			'endDate' => 'required|date|after_or_equal:startDate',
			'description' => 'nullable|string|max:500',
			'tasks' => 'nullable|string',
		]);

		DB::transaction(function () use ($event, $validated) {
			$event->update([
				'name' => $validated['name'],
				'startDate' => Carbon::parse($validated['startDate'])->startOfDay(),
				'endDate' => Carbon::parse($validated['endDate'])->endOfDay(),
				'description' => $validated['description'] ?? null
			]);

			if (!empty($validated['tasks'])) {
				DB::table('eventconditions')->where('eventID', $event->id)->delete();
				$taskIds = explode(",", $validated['tasks']);

				foreach ($taskIds as $taskID) {
					DB::table('eventconditions')->insert([
						'eventID' => $event->id,
						'conditiontypeID' => (int) trim($taskID),
						'quantity' => null,
						'created_at' => now(),
						'updated_at' => null,
					]);
				}
			}
		});

		return redirect()->route('dashboard')->with('success', 'Challenge mis à jour avec succès !');
	}

	public function delete($id)
	{
		$event = Event::find($id);

		if (!$event) {
			return response()->json(['success' => false, 'message' => 'Événement introuvable.']);
		}

		DB::transaction(function () use ($id, $event) {
			DB::table('eventconditions')->where('eventID', $id)->delete();
			$event->delete();
		});

		return response()->json(['success' => true]);
	}

	public function joinToEvent()
	{
		$user = Auth::user();
		$currentEvent = self::getCurrent();

		if (!$currentEvent) {
			return response()->json(['success' => false, 'message' => 'Aucun événement en cours.']);
		}

		// Récupérer les ID des conditions de l'événement actuel
		$conditions = DB::table('eventconditions')
			->where('eventID', $currentEvent['id'])
			->get();

		if ($conditions->isEmpty()) {
			return response()->json(['success' => false, 'message' => 'Aucune condition trouvée pour cet événement.']);
		}

		// Insérer les données dans achievements avec un foreach
		foreach ($conditions as $condition) {
			DB::table('achievements')->insert([
				'userID' => $user->id,
				'eventconditionID' => $condition->id,
				'quantity' => null
			]);
		}

		return response()->json(['success' => true, 'message' => 'Conditions ajoutées aux achievements.']);
	}


	public function exit()
	{
		$user = Auth::user();
		$event = self::getCurrent();

		if (!$event) {
			return redirect(route('dashboard'))->with('error', 'Aucun événement en cours.');
		}

		$deleted = DB::table('event_books')
			->where('eventID', $event['id'])
			->where('userID', $user->id)
			->delete();

		if ($deleted) {
			return redirect(route('dashboard'))->with('success', 'Votre participation a été annulée.');
		} else {
			return redirect(route('dashboard'))->with('error', 'Vous ne participiez pas à cet événement.');
		}
	}

	public function getAllStatistics($eventID = NULL)
	{
		return [
			'countBooks' => self::getEventsBooksStatistics($eventID),
			'countPages' => self::getEventsPagesStatistics($eventID),
			'countReaders' => self::getEventsReadersStatistics($eventID),
			'countEvents' => self::getEventsStatistics(),
		];
	}

	public static function getEventsPagesStatistics($eventID = NULL)
	{
		$count = DB::table('event_books')
			->select(DB::raw('SUM(pageNb) as count'))
			->when($eventID, function ($query) use ($eventID) {
				return $query->where('eventID', $eventID);
			})
			->value('count');

		return ($count == 0) ? null : $count;
	}

	public static function getEventsBooksStatistics($eventID = NULL)
	{
		return DB::table('event_books')
			->when($eventID, fn($query) => $query->where('eventID', $eventID))
			->distinct()
			->count('bookID');
	}

	public static function getEventsReadersStatistics($eventID = NULL)
	{
		$count = DB::table('event_books')
			->when($eventID, function ($query) use ($eventID) {
				return $query->where('eventID', $eventID);
			})
			->distinct('userID')
			->count('userID');

		return ($count == 0) ? null : $count;
	}

	public static function getEventsStatistics()
	{
		$count = Event::count();

		return ($count == 0) ? null : $count;
	}

	public static function getAllConditons()
	{
		$conditions = DB::table('conditiontypes')->get() ?? collect([]);
		return view('components/dashboard/admin/events-create', compact('conditions'));
	}
}
