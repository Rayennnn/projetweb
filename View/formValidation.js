document.getElementById("createUserForm").addEventListener("submit", function(event) {
    const nom = document.getElementById("nom").value;
    const nomFamille = document.getElementById("nom_famille").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("mot_de_passe").value;
    const confirmPassword = document.getElementById("confirm_mot_de_passe").value;

    // Vérification des nombres dans nom et nom de famille
    const nameRegex = /^[a-zA-Z]+$/;
    if (!nameRegex.test(nom) || !nameRegex.test(nomFamille)) {
        event.preventDefault();
        alert("Le nom et le nom de famille ne doivent contenir que des lettres !");
        return;
    }

    // Vérification du format de l'email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        event.preventDefault();
        alert("Veuillez entrer un email valide !");
        return;
    }

    // Vérification des mots de passe
    if (password !== confirmPassword) {
        event.preventDefault();
        alert("Les mots de passe ne correspondent pas !");
        return;
    }
});
