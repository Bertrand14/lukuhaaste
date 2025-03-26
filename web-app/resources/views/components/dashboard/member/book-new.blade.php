<div class="fixed inset-0 bg-black bg-opacity-80 z-100 flex items-center justify-center">
 <div class="bg-white p-8 rounded-lg dark:bg-zinc-800 dark:text-white w-full max-w-[80vw]">
  <h3 class="lg:text-3xl text-lg font-bold text-center">{{ ($action == 'new') ? "Kerro meille mitä luit" : "Päivitä arvostelusi" }}</h3>

  <form class="space-y-6 overflow-auto max-h-[80vh]" action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
 @csrf
 <input type="hidden" id="bookID" name="bookID" value="">

 <!-- Les autres champs de formulaire -->
 <div>
  <label for="bookName" class="block font-medium">Kirjannimi</label>
  <input type="text" id="bookName" name="bookName" class="mt-1 block w-full rounded-md dark:bg-zinc-700 dark:text-white" required>
 </div>

 <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
  <div>
   <label for="bookGenre" class="block font-medium">Genre</label>
   <select id="bookGenre" name="bookGenre[]" multiple class="mt-1 block w-full rounded-md dark:bg-zinc-700 dark:text-white" required>
    @foreach($genres as $genre)
     <option value="{{ $genre->id }}" class="pb-1 border-b-2 border-zinc-800 dark:bg-zinc-700 dark:text-white dark:hover:bg-zinc-600">{{ $genre->name }}</option>
    @endforeach
   </select>
  </div>
  <div>
   <label for="bookPageNumber" class="block font-medium">Sivumäärä</label>
   <input type="number" id="bookPageNumber" name="bookPageNumber" class="[appearance:textfield] mt-1 block w-full rounded-md dark:bg-zinc-700 dark:text-white" required>
  </div>
  <div>
   <label for="bookCover" class="block font-medium">Ulkoasu</label>
   <input type="file" id="bookCover" name="bookCover" accept="image/*" class="mt-1 block w-full rounded-md dark:bg-zinc-700 dark:text-white">
  </div>
 </div>

 <div>
  <label for="bookSynopsis" class="block font-medium">Tiivistelmä</label>
  <textarea id="bookSynopsis" name="bookSynopsis" rows="4" class="mt-1 block w-full rounded-md dark:bg-zinc-700 dark:text-white" required></textarea>
 </div>
 <button @click="addBook= false" type="button" class="inline-flex items-center px-6 py-2 text-green-700 bg-white/70 hover:bg-green-800 hover:text-white/70 focus:outline-none rounded-md shadow-md">Peruuta</button>
 <button type="submit" class="inline-flex items-center px-6 py-2 text-white bg-green-700 hover:bg-green-800 focus:outline-none rounded-md shadow-md">Tallenna</button>
</form>

 </div>
</div>