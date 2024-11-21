document.addEventListener('DOMContentLoaded', function () {
    // Initialisation du graphique
    let clubsChart;
 
    const initChart = () => {
        const ctx = document.getElementById('clubsChart').getContext('2d');
        clubsChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Culture', 'Sport', 'Technologie', 'Art', 'Social', 'Scientifique', 'Environnement'],
                datasets: [{
                    data: [3, 4, 2, 1, 2, 1, 1], // Données fictives
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56',
                        '#4BC0C0', '#9966FF', '#FF9F40', '#47B39C'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    };
 
    // Validation du formulaire
    const validateForm = () => {
        const form = document.querySelector('form');
        const nomInput = document.querySelector('[name="nom_club"]');
        const descriptionInput = document.querySelector('[name="description"]');
        const logoInput = document.querySelector('[name="logo"]');
        const successMessage = document.querySelector('#formSuccess');
 
        form.addEventListener('submit', function (e) {
            e.preventDefault();
 
            // Réinitialiser les messages d'erreur
            document.querySelectorAll('.error-message').forEach(error => error.textContent = '');
 
            let isValid = true;
 
            // Validation du nom du club
            if (nomInput.value.trim().length < 3) {
                document.querySelector('#nomError').textContent = 'Le nom du club doit contenir au moins 3 caractères.';
                isValid = false;
            }
 
            // Validation de la description
            if (descriptionInput.value.trim().length < 10) {
                document.querySelector('#descriptionError').textContent = 'La description doit contenir au moins 10 caractères.';
                isValid = false;
            }
 
            // Validation du logo
            const logoFile = logoInput.files[0];
            if (logoFile) {
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(logoFile.type)) {
                    document.querySelector('#logoError').textContent = 'Le logo doit être au format JPG, PNG ou GIF.';
                    isValid = false;
                }
                if (logoFile.size > 5000000) { // 5 MB
                    document.querySelector('#logoError').textContent = 'Le logo ne doit pas dépasser 5 MB.';
                    isValid = false;
                }
            }
 
            // Si toutes les validations sont réussies
            if (isValid) {
                const formData = new FormData(form);
 
                // Envoi des données via AJAX (fetch)
                fetch('../../../Controller/add_club.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            successMessage.textContent = data.message;
                            successMessage.style.color = 'green';
                            form.reset();
                            document.querySelector('#logoPreview').innerHTML = '';
                            updateStats();
                        } else {
                            throw new Error(data.error || 'Erreur inconnue');
                        }
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        successMessage.textContent = 'Une erreur est survenue lors de l\'ajout du club.';
                        successMessage.style.color = 'red';
                    });
            }
        });
    };
 
    // Aperçu du logo
    const initLogoPreview = () => {
        const logoInput = document.querySelector('[name="logo"]');
        const previewDiv = document.querySelector('#logoPreview');
 
        logoInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewDiv.innerHTML = `<img src="${e.target.result}" alt="Aperçu du logo" style="max-width: 200px;">`;
                };
                reader.readAsDataURL(file);
            } else {
                previewDiv.innerHTML = ''; // Réinitialiser si aucun fichier n'est sélectionné
            }
        });
    };
 
    // Mettre à jour les statistiques dynamiquement
    const updateStats = () => {
        fetch('get_club_stats.php')
            .then(response => {
                if (!response.ok) {
 throw new Error('Erreur lors de la récupération des statistiques.');
                }
                return response.json();
            })
            .then(data => {
                // Mettre à jour les données des statistiques
                document.querySelector('.amount').textContent = data.totalClubs;
                clubsChart.data.datasets[0].data = data.categoriesData;
                clubsChart.update();
            })
            .catch(error => console.error('Erreur:', error));
    };
 
    // Initialisation
    initChart();
    validateForm();
    initLogoPreview();
 });