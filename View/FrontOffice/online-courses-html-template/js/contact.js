document.getElementById('suggestionForm').addEventListener('submit', function(event) {
    const userId = document.getElementById('user_email').value.trim();
    const typeFeedback = document.getElementById('subject').value;
    const contenu = document.getElementById('message').value.trim();

    if (!userId || isNaN(userId)) {
        alert('Veuillez entrer un mail valide.');
        event.preventDefault();
    } else if (!typeFeedback) {
        alert('Veuillez choisir un sujet.');
        event.preventDefault();
    } else if (contenu.length < 5) {
        alert('Votre message doit contenir au moins 5 caractères.');
        event.preventDefault();
    }
});
