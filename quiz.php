<?php include 'includes/header.php'; ?>
<?php include("includes/auth_check.php"); ?>
<div class="container">
    <div class="quiz-container mt-5" id="quizContainer">
        <!-- Quiz Header -->
        <div class="quiz-header p-4">
            <h4><i class="fas fa-quiz me-2"></i>Test di Valutazione</h4>
        </div>

        <!-- Quiz Content -->
        <div class="quiz-body p-4">
            <div class="progress mb-4">
                <div class="progress-bar" id="quizProgress" role="progressbar"></div>
            </div>
            <!-- Question count -->
            <div id="questionCount" class="mb-3 text-center">Domanda 1/10</div>

            <div id="questionContainer"></div>

            <div class="quiz-navigation d-flex justify-content-between mt-4">
                <button class="btn btn-secondary" id="prevBtn" disabled>
                    <i class="fas fa-arrow-left"></i> Precedente
                </button>
                <button class="btn btn-primary" id="nextBtn">
                    Successiva <i class="fas fa-arrow-right"></i>
                </button>
                <button class="btn btn-success" id="submitBtn" style="display:none;">
                    Invia 
                </button>
            </div>
        </div>
    </div>

    <div class="quiz-loader" id="quizLoader" style="display: none;">
        <div class="loader-content text-center p-4">
            <div class="spinner-border text-primary mb-3" role="status">
                <span class="visually-hidden">Caricamento...</span>
            </div>
            <h5>Inviando i risultati del test...</h5>
            <p>Perfavore aspetta mentre processiamo le tue risposte.</p>
        </div>
    </div>

    <!-- Results Message -->
    <div id="quizResults" class="text-center" style="display:none;">
        <h3>Grazie per aver completato il test!</h3>
        <p>Il tuo punteggio è di: <span id="quizScore"></span> / 10</p>
        <button class="btn btn-primary" id="replayBtn">Ricomincia il test</button>
    </div>
</div>

<style>
#scene {
    display: none !important;
}

.hero-section .container {
    display: none !important;
}

.hero-section {
    padding-top: 0px !important;
    padding-bottom: 250px;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: bottom center;
    margin-bottom: 0px !important;
}

/* Same styles as before */
.quiz-container {
    background: white;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.quiz-header {
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

.question-card {
    display: none;
}

.question-card.active {
    display: block;
    animation: fadeIn 0.4s;
}

.quiz-option {
    padding: 12px 15px;
    margin: 8px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.2s;
}

.quiz-option:hover {
    background: #f8f9fa;
}

.quiz-option.selected {
    background: #e7f1ff;
    border-color: #0d6efd;
}

.quiz-loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.9);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.loader-content {
    background: white;
    border-radius: 10px;
    padding: 2rem;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    max-width: 400px;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    //  quiz question 
    const quizData = [{
            question: "Secondo l'art. 3 del D.Lgs 81/2008 il campo di applicazione della normativa riguarda:",
            options: ["le amministrazioni pubbliche", "il settore privato", "i settori di attività privata e pubblica", "Nessuna delle precedenti"],
            answer: "i settori di attività privata e pubblica"
        },
        {
            question: "Chi e' secondo l'art. 2 del D.Lgs 81/2008 il datore di lavoro [DL]?",
            options: ["L'ente da cui dipende il lavoratore ", "il proprietario della ditta ", "colui che è titolare del rapporto di lavoro con il lavoratore o colui che ha la responsabilità dell'impresa o dell'unità produttiva", "Colui che assegna i ruoli"],
            answer: "colui che è titolare del rapporto di lavoro con il lavoratore o colui che ha la responsabilità dell'impresa o dell'unità produttiva"
        },
        {
            question: "Quale è la differenza tra pericolo e rischio? ",
            options: ["il rischio è un pericolo che si può misurare", "il rischio è un pericolo che genera un danno potenziale", "il rischio è la probabilità che un pericolo produca un dato effetto", "il rischio è misurabile mentre il pericolo no"],
            answer: "il rischio è la probabilità che un pericolo produca un dato effetto"
        },
        {
            question: "Quale potrebbe essere una definizione quantitativa di rischio? ",
            options: ["rischio = probabilità dell'evento + effetto", "rischio= probabilità dell'evento x effetto", "rischio= pericolo x danno", "Non può essere definito"],
            answer: "rischio= probabilità dell'evento x effetto"
        },
        {
            question: "Da che cosa si parte in una valutazione dei rischi? ",
            options: ["dall'analisi degli incidenti occorsi", "dall'analisi dei pericoli del sistema", "dal confronto con organizzazioni simili del settore", "dall'analisi dei dati statistici"],
            answer: "dall'analisi dei pericoli del sistema"
        },
        {
            question: "Nella Gestione del Rischio è indispensabile definire ruoli e responsabilità?",
            options: ["sì, sempre", "dipende dal contesto, e dalle eventuali normative del settore", "no, se l'organizzazione non ha mai registrato incidenti.", "no,mai"],
            answer: "sì, sempre"
        },
        {
            question: "Qual è il primo passo in un'emergenza sul campo?",
            options: ["seguire le procedure", "riconoscere o nominare il leader delle operazioni", "effettuare immediatamente l'esame della situazione", "nessuna delle precedenti"],
            answer: "riconoscere o nominare il leader delle operazioni"
        },
        {
            question: "La gestione del rischio significa anche gestire gli errori. Quale può essere una definizione di errore?",
            options: [
                "deviazione dagli obiettivi",
                "pericolo relativo prevalentemente al solo fattore umano",
                "pericolo derivante dalla non osservanza delle procedure",
                "pericolo uguale al rischio"
            ],
            answer: "pericolo relativo prevalentemente al solo fattore umano"
        },
        {
            question: "Cosa si valuta durante una valutazione dei rischi?",
            options: ["Rischi , pericoli , esposizioni , danni", "rischi , omissioni , negligenza , pericoli", "Pericoli , danni , agenti atmosferici , dimenticanze", "Nessuna delle precedenti"],
            answer: "Rischi , pericoli , esposizioni , danni"
        },
        {
            question: "Cosa si intende con la sigla DPI di cui all'art. 74 del D.Lgs 81/2008? ",
            options: [
                "dispositivi di protezione individuale ",
                "dispositivi di prevenzione individuale ",
                "dispositivi di protezione indispensabili ",
                "dispositivi di precenzione istituzionali"],
            answer: "dispositivi di protezione individuale "
        },
    ];

    let currentQuestion = 0;
    let userAnswers = Array(quizData.length).fill(null);

    function initQuiz() {
        // Reset the results message
        $('#quizResults').hide();
        $('#quizScore').text('');
        $('#quizLoader').hide();
        $('.quiz-navigation').show();
        $('#quizContainer').show(); // Show quiz container when starting

        quizData.forEach((q, i) => {
            $('#questionContainer').append(`
                <div class="question-card" id="q${i}">
                    <h5 class="mb-4">${q.question}</h5>
                    <div class="options">
                        ${q.options.map((opt, j) => `
                            <div class="quiz-option" data-q="${i}" data-opt="${j}">
                                ${opt}
                            </div>
                        `).join('')}
                    </div>
                </div>
            `);
        });
        showQuestion(0);
    }

    function showQuestion(index) {
        $('.question-card').removeClass('active');
        $(`#q${index}`).addClass('active');

        // Update progress
        $('#quizProgress').css('width', `${((index + 1) / quizData.length) * 100}%`);

        // Update question count
        $('#questionCount').text(`Question ${index + 1}/${quizData.length}`);

        // Update buttons
        $('#prevBtn').prop('disabled', index === 0);
        $('#nextBtn').toggle(index < quizData.length - 1);
        $('#submitBtn').toggle(index === quizData.length - 1);

        // Highlight selected answer
        if (userAnswers[index] !== null) {
            $(`.quiz-option[data-q="${index}"]`).removeClass('selected');
            $(`.quiz-option[data-q="${index}"][data-opt="${userAnswers[index]}"]`).addClass('selected');
        }
    }

    // Navigation
    $('#prevBtn').click(() => {
        currentQuestion--;
        showQuestion(currentQuestion);
    });

    $('#nextBtn').click(() => {
        if (userAnswers[currentQuestion] === null) {
            // showMessage('plz Select an answer !', 'message');
            return;
        }
        currentQuestion++;
        showQuestion(currentQuestion);
    });

    // Option selection
    $('#questionContainer').on('click', '.quiz-option', function() {
        const qIndex = $(this).data('q');
        const optIndex = $(this).data('opt');

        $(`.quiz-option[data-q="${qIndex}"]`).removeClass('selected');
        $(this).addClass('selected');
        userAnswers[qIndex] = optIndex;
    });

    // Submit quiz
    $('#submitBtn').click(function() {
        if (userAnswers[currentQuestion] === null) {
            // showMessage('plz Select an answer !', 'message');
            return;
        }

        $('#quizLoader').fadeIn();
        $('#submitBtn').prop('disabled', true);

        // Calculate score
        let score = 0;
        const results = quizData.map((q, i) => {
            const isCorrect = userAnswers[i] !== null &&
                q.options[userAnswers[i]] === q.answer;
            if (isCorrect) score++;
            return {
                question: q.question,
                selected: userAnswers[i] !== null ? q.options[userAnswers[i]] : 'Non risposto',
                correct: q.answer,
                isCorrect: isCorrect
            };
        });

        // Hide quiz and show results
        $('#quizLoader').fadeOut();
        $('#quizContainer').hide(); // Hide the quiz container
        $('#quizResults').show();
        $('#quizScore').text(score);
    });

    // Replay quiz
    $('#replayBtn').click(function() {
        currentQuestion = 0;
        userAnswers = Array(quizData.length).fill(null);
        $('#quizResults').hide();
        $('#quizScore').text('');
        $('#questionContainer').empty();
        initQuiz();
    });

    initQuiz();
});
</script>

<?php include 'includes/footer.php'; ?>