<?php
include '../../controller/suggestionC.php';

$suggestionC = new SuggestionC();
$stats = $suggestionC->getStatistiques();
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 6; // Ou toute autre limite souhaitée
$offset = ($page - 1) * $limit;

// Appeler la méthode avec les arguments nécessaires
$suggestions = $suggestionC->getSuggestions($limit, $offset);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques des Suggestions</title>
    <link rel="stylesheet" href="../css/backoffice.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="sidebar">
        <div class="sidebar-header">
            <h2>Dashboard</h2>
        </div>
        <div class="sidebar-menu">
            <a href="addrepsuggestion.php"><i class="fas fa-plus"></i> Ajouter une réponse</a>
            <a href="listrepsuggestion.php"><i class="fas fa-list"></i> Liste des réponses</a>
            <a href="listSuggestions.php"><i class="fas fa-list"></i> Liste des suggestions et reclamtions</a>
            <a href="statistiques.php" class="nav-link"><i class="fas fa-chart-pie"></i> Statistiques</a>
        </div>
        
    </div>

    <div class="main-content">
        <div class="page-header">
            <h1>Statistiques des Suggestions</h1>
        </div>

        <div class="stats-container">
            <!-- Cartes des statistiques -->
            <div class="stats-cards">
                <div class="stat-card total">
                    <i class="fas fa-list-alt"></i>
                    <div class="stat-value"><?php echo $stats['total']; ?></div>
                    <div class="stat-label">Total des suggestions</div>
                </div>
                
                <div class="stat-card traite">
                    <i class="fas fa-check-circle"></i>
                    <div class="stat-value"><?php echo $stats['traitée']['percentage']; ?>%</div>
                    <div class="stat-label">Traitées (<?php echo $stats['traitée']['count']; ?>)</div>
                </div>
                
                <div class="stat-card rejete">
                    <i class="fas fa-times-circle"></i>
                    <div class="stat-value"><?php echo $stats['rejetée']['percentage']; ?>%</div>
                    <div class="stat-label">Rejetées (<?php echo $stats['rejetée']['count']; ?>)</div>
                </div>
                
                <div class="stat-card en-attente">
                    <i class="fas fa-hourglass-half"></i>
                    <div class="stat-value"><?php echo $stats['en_attente']['percentage']; ?>%</div>
                    <div class="stat-label">En attente (<?php echo $stats['en_attente']['count']; ?>)</div>
                </div>
            </div>
            <style>
                .charts-container {
                    display: flex;
                    justify-content: space-between;
                    gap: 30px;
                }

                .chart-wrapper {
                    width: 100%; /* Chaque graphique prend 45% de l'espace */
                    height: 350px; /* Hauteur fixe pour les graphiques */
                }
                /* Conteneur principal */
                .stats-cards {
                    display: flex;
                    justify-content: space-between;
                    flex-wrap: wrap;
                    gap: 60px;
                    margin-top: 20px;
                }

                /* Style de base pour chaque carte */
                .stat-card {
                    flex: 1 1 calc(25% - 10px);
                    max-width: 200px;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
                    text-align: center;
                    background: #f9f9f9;
                    transition: transform 0.2s ease, box-shadow 0.2s ease;
                }

                /* Effet au survol */
                .stat-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
                }

                /* Couleurs spécifiques */
                .stat-card.total {
                    background: #3498db;
                    color: white;
                }

                .stat-card.traite {
                    background: #2ecc71;
                    color: white;
                }

                .stat-card.rejete {
                    background: #e74c3c;
                    color: white;
                }

                .stat-card.en-attente {
                    background: #f1c40f;
                    color: black;
                }

                /* Icônes */
                .stat-card i {
                    font-size: 2.5rem;
                    margin-bottom: 15px;
                    display: block;
                    color: rgba(255, 255, 255, 0.9); /* Couleur légèrement atténuée */
                }

                /* Valeur */
                .stat-card .stat-value {
                    font-size: 2rem;
                    font-weight: bold;
                    margin-bottom: 20px;
                }

                /* Étiquette */
                .stat-card .stat-label {
                    font-size: 1.2rem;
                    font-weight: normal;
                }

            </style>

            <!-- Graphiques -->
            <div class="charts-container">
                <div class="chart-wrapper">
                    <canvas id="statusChart" style="height: 350px;"></canvas>
                </div>
                <div class="chart-wrapper">
                    <canvas id="typeChart" style="height: 350px;"></canvas>
                </div>
            </div>

        </div>
                <div class="statistics-section">
            <h3>Statistiques des Suggestions</h3>
            <table class="table">
                <thead>
                    <tr>
                        
                        <th>Suggestion</th>
                        <th>Date de Soumission</th>
                        <th>Likes</th>
                        <th>Dislikes</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        // Assurez-vous de vérifier si $suggestions contient des données
                        if (isset($suggestions) && is_array($suggestions)) {
                            foreach ($suggestions as $index => $suggestion) {
                                echo "<tr>
                                    
                                        <td>{$suggestion['contenu']}</td>
                                        <td>{$suggestion['date_soumission']}</td>
                                        <td>{$suggestion['likes']}</td>
                                        <td>{$suggestion['dislikes']}</td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Aucune suggestion disponible.</td></tr>";
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
                
    <script>
           const chartOptions = {
    responsive: true,
    maintainAspectRatio: false, // Permet de personnaliser la hauteur/largeur
    plugins: {
        title: {
            display: true,
            text: '',
        },
        legend: {
            position: 'bottom', // Place la légende en bas pour économiser de l'espace
        }
    }
};

// Graphique des statuts
// Graphique des statuts
new Chart(document.getElementById('statusChart'), {
    type: 'pie',
    data: {
        labels: ['Traitée', 'Rejetée', 'En attente'],
        datasets: [{
            data: [
                <?php echo $stats['traitée']['count'] ?? 0; ?>,
                <?php echo $stats['rejetée']['count'] ?? 0; ?>,
                <?php echo $stats['en_attente']['count'] ?? 0; ?>
            ],
            backgroundColor: ['#2ecc71', '#e74c3c', '#f1c40f']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // Permet de contrôler la taille dans le CSS
        plugins: {
            title: {
                display: true,
                text: 'Répartition par statut',
                font: {
                    size: 24 // Taille du texte du titre
                }
            },
            legend: {
                labels: {
                    font: {
                        size: 20 // Taille du texte des légendes
                    }
                }
            }
        }
    }
});

new Chart(document.getElementById('typeChart'), {
    type: 'pie',
    data: {
        labels: ['Suggestions', 'Réclamations'],
        datasets: [{
            data: [
                <?php echo $stats['par_type']['suggestion']['count']; ?>,
                <?php echo $stats['par_type']['reclamation']['count']; ?>
            ],
            backgroundColor: ['#3498db', '#e6680e']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // Permet de contrôler la taille dans le CSS
        plugins: {
            title: {
                display: true,
                text: 'Répartition par type',
                font: {
                    size: 24 // Taille du texte du titre
                }
            },
            legend: {
                labels: {
                    font: {
                        size: 20 // Taille du texte des légendes
                    }
                }
            }
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const likeButtons = document.querySelectorAll('.like-btn');
    const dislikeButtons = document.querySelectorAll('.dislike-btn');

    // Fonction pour gérer les votes
    function sendVote(id, action) {
        fetch('/projetweb/view/backoffice/updateVotes.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${id}&action=${action}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Rafraîchir la page ou mettre à jour les éléments du DOM pour refléter les nouveaux votes
                location.reload(); // Recharger la page pour voir les votes mis à jour
            } else {
                alert('Une erreur est survenue lors du vote');
            }
        })
        .catch(error => console.error('Erreur lors du vote:', error));
    }

    // Ajouter les écouteurs d'événements sur les boutons "Like"
    likeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            sendVote(id, 'like');
        });
    });

    // Ajouter les écouteurs d'événements sur les boutons "Dislike"
    dislikeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            sendVote(id, 'dislike');
        });
    });
});


    </script>
    

</body>
</html>
