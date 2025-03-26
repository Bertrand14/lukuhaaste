<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
<script>
   $(function () {
    function makeDraggable(element) {
        element.draggable({
            revert: "invalid",
            helper: "clone",
            start: function (event, ui) {
                $(this).css({ visibility: "hidden" });
            },
            stop: function (event, ui) {
                $(this).css({ visibility: "visible" });
            }
        });
    }

    makeDraggable($(".draggable"));

    function updateTasks() {
    var selectedTasks = $("#droppable .draggable").map(function () {
        return this.id;
        }).get();
        $("#tasks").val(selectedTasks.join(","));
    }

// Appelle cette fonction après chaque ajout/retrait
$("#droppable").droppable({
    accept: ".draggable",
    drop: function (event, ui) {
        var droppable = $(this);
        var draggable = ui.helper.clone().css({
            position: "static",
            left: "auto",
            top: "auto",
            visibility: "visible",
            cursor: "pointer"
        }).appendTo(droppable);

        ui.draggable.remove();
        ui.helper.remove();

        makeDraggable(draggable);
        updateTasks(); // Met à jour les valeurs du champ hidden
         // Permet de cliquer sur l'élément pour le retirer et le remettre dans sa section d'origine
         draggable.on("click", function () {
                returnToOrigin($(this));
            });
    }
});
    // Au clic sur un élément de la liste d'origine, l'ajouter directement à #droppable
    $(".draggable").on("click", function () {
        var original = $(this);
        var clone = original.clone().css({ cursor: "pointer" });

        clone.appendTo("#droppable").css({
            position: "static",
            left: "auto",
            top: "auto",
            visibility: "visible"
        });

        original.remove();

        // Permet de cliquer sur l'élément pour le retirer de #droppable
        clone.on("click", function () {
            returnToOrigin($(this));
        });

        updateTasks();
    });

    // Fonction pour renvoyer l'élément à sa section d'origine
    function returnToOrigin(element) {
        var id = element.attr("id");
        var originalSection = $(".vaihtoehdot"); // Sélecteur de la liste d'origine

        // Vérifie si l'élément n'est pas déjà dans la liste
        if (originalSection.find("#" + id).length === 0) {
            var clone = element.clone();
            clone.appendTo(originalSection).css({
                position: "static",
                left: "auto",
                top: "auto",
                visibility: "visible",
                cursor: "pointer"
            });

            makeDraggable(clone); // Rend l'élément à nouveau draggable
        }

        element.remove();
        updateTasks();
    }
});

document.querySelector('form').addEventListener('submit', function (e) {
    console.log([...new FormData(this).entries()]);
});

$('form').on('submit', function (e) {
    console.log($('#name').val(), $('#startDate').val(), $('#endDate').val(), $('#description').val());
});

</script>

<x-app-layout id="new-event">
    <section>
        <h2>Suunnittele uusi lukuhaaste tähän</h2>
        <form method="POST" action="{{ route('event.store') }}">
            @csrf
            Haaste 
            <input id="name" name="name" type="text" placeholder="Anna nimi haasteelle." required > 
            alkaa
            <input id="startDate" name="startDate" type="date" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" required/>
            ja loppu
            <input id="endDate" name="endDate" type="date" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" required >.<br />
            Haasteeseen kuuluvat seuraavat tehtävät (valitse tehtävät oikealla olevalta listalta)
            <div id="droppable" class="ui-widget-header"></div>
            <input type="hidden" name="tasks" id="tasks">
            <textarea id="description" name="description" placeholder="Voit kirjoittaa tähän kenttään miten tämä haaste toimii."  maxlength="500"></textarea>
            <button type="submit">Tallenna</button>
        </form>
    </section>
    <section class="vaihtoehdot">
        <h2>Vaihtoehdot</h2>
        <i>Raahaa tai klikkaa suunnitelmaan.</i>
        @foreach($conditions as $condition)
            <p class="draggable ui-widget-content" id="{{ $condition->id }}">{{ $condition->name }}</p>
        @endforeach
    </section>

</x-app-layout>

