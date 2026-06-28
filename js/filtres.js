document.addEventListener('DOMContentLoaded', function() {

    // Bouton toggle filtres
    document.getElementById('btn-toggle-filtres').addEventListener('click', function() {
        var panel = document.getElementById('filtres-panel');
        panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
    });

    // Bouton filtrer
    document.getElementById('btn-filtrer').addEventListener('click', function() {
        var type = document.getElementById('filtre-type').value;
        var categorie = document.getElementById('filtre-categorie').value;

        var url = BASE_URL + 'api/filtrer-fiches.php?';
        if (type) url += 'type=' + type + '&';
        if (categorie) url += 'categorie=' + categorie + '&';

        fetch(url)
            .then(function(response) { return response.json(); })
            .then(function(fiches) {
                var grille = document.getElementById('fiches-grid');
                grille.textContent = '';

                if (fiches.length === 0) {
                    var p = document.createElement('p');
                    p.className = 'text-center';
                    p.textContent = 'Aucune fiche trouvée.';
                    grille.appendChild(p);
                } else {
                    for (var i = 0; i < fiches.length; i++) {
                        var f = fiches[i];

                        var col = document.createElement('div');
                        col.className = 'col-md-4 mb-4';

                        var card = document.createElement('div');
                        card.className = 'card h-100 border-0';

                        var img = document.createElement('img');
                        img.src = BASE_URL + 'images/' + f.image;
                        img.alt = f.nom;
                        img.className = 'card-img-top fiche-image';
                        card.appendChild(img);

                        var body = document.createElement('div');
                        body.className = 'card-body text-center';

                        var titre = document.createElement('h3');
                        titre.textContent = f.prenom ? f.prenom + ' ' + f.nom : f.nom;
                        body.appendChild(titre);

                        var lien = document.createElement('a');
                        var id = f.type === 'personnage' ? f.personnage_id : f.lieu_id;
                        lien.href = BASE_URL + 'pages/' + f.type + '.php?id=' + id;
                        lien.className = 'btn btn-dark btn-sm mt-2';
                        lien.textContent = 'Découvrir';
                        body.appendChild(lien);

                        card.appendChild(body);
                        col.appendChild(card);
                        grille.appendChild(col);
                    }
                }
            });
    });

    // Bouton reset
    document.getElementById('btn-reset').addEventListener('click', function() {
        document.getElementById('filtre-type').value = '';
        document.getElementById('filtre-categorie').value = '';
        document.getElementById('btn-filtrer').click();
    });

});