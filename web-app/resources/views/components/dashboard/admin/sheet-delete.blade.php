<div>
    <h2>Vahvista poisto</h2>
    <p>
        Haluatko todella poistaa <strong x-text="Alpine.store('popUpDelete').item?.name"></strong>?
    </p>
    <div class="buttons">
        <button
            @click="Alpine.store('popUpDelete').closePopup()"
            class="info">
            Peruuta
        </button>

        <button @click="deleteItem()" class="danger">Poista</button>
    </div>
</div>

<script>
    function deleteItem() {
        console.log('Suppression en cours...');

        const item = Alpine.store('popUpDelete').item;
        const table = Alpine.store('popUpDelete').tableName;
        if (!item || !table) {
            console.error('Erreur : Données manquantes pour la suppression.');
            return;
        }

        fetch(`/${table}/delete`, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    id: item.id
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(`Suppression réussie de ${item.name} dans la table ${table}`);
                    location.reload();
                } else {
                    console.error('Erreur lors de la suppression.');
                }
            });

        Alpine.store('popUpDelete').closePopup();
    }
</script>