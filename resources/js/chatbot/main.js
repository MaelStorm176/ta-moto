function showBot(){
    let bot = document.getElementById('bot-container');
    if(bot.classList.contains('none')){
        bot.classList.remove("none");
        bot.classList.add("display");
    }else{
        bot.classList.remove("display");
        bot.classList.add("none");
    }
}

const chat = {
    1: {
        text: 'Bonjour, bienvenue sur notre site de vente de motos.',
        options: [
            {
                text: '👋',
                next: 2
            }
        ]
    },
    2: {
        text: 'Je suis votre chatbot personnel pour vous accompagner.',
        next: 3
    },
    3: {
        text: 'Que souhaitez-vous faire?',
        options: [
            {
                text: "Je souhaite vérifier l’entretien de mon véhicule",
                next: 4
            },
            {
                text: "Je souhaite des informations sur les véhicules",
                next: 8
            },
            {
                text: "Je souhaite des informations de contact",
                next: 14
            }
        ]
    },
    4: {
        text: 'Quelle est l\'année de votre véhicule ?',
        input: true,
        id: 'year',
        next: 5
    },
    5: {
        text: 'Quand a été effectué le dernier entretien de votre véhicule?',
        input: true,
        id: 'last',
        next: 6
    },
    6: {
        text: 'Combien de kilomètres avez-vous parcouru depuis le dernier entretien?',
        input: true,
        id: 'km',
        next: 7
    },
    7: {
        text: 'Souhaitez-vous réviser votre véhicule maintenant?',
        options: [
            {
                text: "Oui",
                next: 9
            },
            {
                text: "Non",
                next: 1
            }
        ]
    },
    8: {
        text: 'Très bien. Quel est votre usage prévu pour le véhicule?',
        options: [
            {
                text: "Usage routier",
                next: 10
            },
            {
                text: "Usage tout-terrain",
                next: 11
            },
            {
                text: "Usage sportif",
                next: 12
            }
        ]
    },
    9: {
        text: 'Voici les disponibilités pour la révision de votre véhicule: ...',
        next: 13
    },
    10: {
        text: 'Très bien, nous vous proposons un essai routier. Voici les disponibilités: ...',
        next: 13
    },
    11: {
        text: 'Très bien, nous vous proposons un essai tout-terrain. Voici les disponibilités: ...',
        next: 13
    },
    12: {
        text: 'Très bien, nous vous proposons un essai sur piste. Voici les disponibilités: ...',
        next: 13
    },
    13: {
        text: 'Veuillez sélectionner une date pour votre rendez-vous:',
        options: [
            {
                text: "Sélectionner une date",
                next: 15
            }
        ]
    },
    14: {
        text: 'Que cherchez-vous?',
        options: [
            {
                text: "Adresse email de contact",
                next: 16
            },
            {
                text: "Numéro de téléphone",
                next: 17
            }
        ]
    },
    15: {
        text: 'Votre rendez-vous a été enregistré côté serveur. Merci de votre confiance.',
    },
    16: {
        text: 'Voici notre adresse email: contact@notre-site.com',
    },
    17: {
        text: 'Voici notre numéro de téléphone: 01 02 03 04 05',
    }
};


const bot = function () {
    const bot = document.getElementById('bot');
    const container = document.getElementById('bot-container');
    const inner = document.getElementById('bot-inner');
    let restartButton = null;
    const sleep = function (ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    };
    const scrollContainer = function () {
        inner.scrollTop = inner.scrollHeight;
    };
    const insertNewChatItem = function (elem) {
        //container.insertBefore(elem, bot);
        bot.appendChild(elem);
        scrollContainer();
        //debugger;
        elem.classList.add('activated');
    };
    const waitForInput = function (id) {
        return new Promise(resolve => {
            const input = document.getElementById(id);
            // Stockez la fonction de résolution de la promesse dans une variable
            const resolvePromise = function (event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    resolve(input.value);
                }
            };
            input.addEventListener('keydown', resolvePromise);
            // Ajoutez un écouteur d'événement 'focusout' sur le champ de saisie de texte
            input.addEventListener('focusout', function () {
                // Enlever l'écouteur d'événement 'keydown' sur le champ de saisie de texte
                input.removeEventListener('keydown', resolvePromise);
                // Résoudre la promesse avec la valeur du champ de saisie de texte
                resolve(input.value);
            });
        });
    };

    const printResponse = async function (step) {
        const response = document.createElement('div');
        response.classList.add('chat-response');
        response.innerHTML = step.text;
        insertNewChatItem(response);
        await sleep(1500);
        if (step.input) {
            const input = document.createElement('input');
            input.type = 'text';
            input.classList.add('input');
            input.id = step.id;
            insertNewChatItem(input);
            const value = await waitForInput(step.id);
            if(value){
                const response = document.createElement('div');
                response.classList.add('chat-ask');
                response.innerHTML = value;
                insertNewChatItem(response);
            }
            await printResponse(chat[step.next]);
        }else if (step.options) {
            const choices = document.createElement('div');
            choices.classList.add('choices');
            step.options.forEach(function (option) {
                const button = document.createElement(option.url ? 'a' : 'button');
                button.classList.add('choice');
                button.innerHTML = option.text;
                if (option.url) {
                    button.href = option.url;
                } else {
                    button.dataset.next = option.next;
                }
                choices.appendChild(button);
            });
            insertNewChatItem(choices);
        } else if (step.next) {
            await printResponse(chat[step.next]);
        }
    };
    const printChoice = function (choice) {
        const choiceElem = document.createElement('div');
        choiceElem.classList.add('chat-ask');
        choiceElem.innerHTML = choice.innerHTML;
        insertNewChatItem(choiceElem);
    };
    const disableAllChoices = function () {
        const choices = document.querySelectorAll('.choice');
        choices.forEach(function (choice) {
            choice.disabled = 'disabled';
        });
    };
    const handleChoice = async function (e) {
        if (!e.target.classList.contains('choice') || 'A' === e.target.tagName) {
            // Target isn't a button, but could be a child of a button.
            const button = e.target.closest('#bot-container .choice');
            if (button !== null) {
                button.click();
            }
            return;
        }
        e.preventDefault();
        const choice = e.target;
        disableAllChoices();
        printChoice(choice);
        scrollContainer();
        await sleep(1500);
        if (choice.dataset.next) {
            await printResponse(chat[choice.dataset.next]);
        }
        // Need to disable buttons here to prevent multiple choices
    };
    const handleRestart = function () {
        startConversation();
    }
    const startConversation = function () {
        printResponse(chat[1]);
    }
    const init = function () {
        //container.addEventListener('click', handleChoice);
        //startConversation();
    };
    //init();
}
bot();
