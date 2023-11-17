//title animation
var typed = new Typed('#element', {
  strings: ['Just ^300 type.'],
  typeSpeed: 100,
  showCursor: true,
  cursorChar: '　',
});


//focus the textfield on load
function focusGameField() {
  document.getElementById("gameField").focus();
}
focusGameField();


//flash on mistake
function turnRed(id) {
  var element = $("#" + id);
  var originalColor = element.css("color");
  element.css("color", "red");
}
function turnWhite(id) {
  var color = {r:245, g:245, b:245};
  var element = $('#' + id);
  $({r:255, g:0, b:0}).animate(color, {
      duration: 250,
      step: function(now, fx) {
          var rgb = 'rgb(' + Math.round(this.r) + ',' + Math.round(this.g) + ',' + Math.round(this.b) + ')';
          element.css('color', rgb);
      }
  });
}
function flashRed(id) {
  turnRed(id);
  turnWhite(id);
}

//read from localstorage
let shuffle = localStorage.getItem('shuffle') !== 'false';

//gamemode button
document.getElementById('toggleGamemode').innerHTML = shuffle ? '<i class="fa-solid fa-book" style="color: #f5f5f5;"></i>' : '<i class="fa-solid fa-book" style="color: #adc7ff;"></i>';
document.getElementById('toggleGamemode').addEventListener('click', function() {
    shuffle = !shuffle;
    localStorage.setItem('shuffle', shuffle);
    location.reload();
});


//game logic
words.sort(() => shuffle ? Math.random() - 0.5 : 0);
let currentWordIndex = 0;
let currentCharIndex = 0;
let errors = 0;
let correct = 0;
let timer;
let startTime;

let gameMessages = document.getElementById('game-messages');
let gameIncorrect = document.getElementById('game-incorrect');
let gameOverText = document.getElementById('gameovertext');

window.onload = function() {
  var gameField = document.getElementById("gameField");
  if(!shuffle) {
    let randomIndex = Math.floor(Math.random() * poems.length);
    words = poems[randomIndex];
  }
  gameField.size = words[0].length;

  document.getElementById("game-messages").innerHTML = words.map(word => `<span class="word">${word}</span>`).join("");
  
  if(shuffle) {
  document.getElementById("timer").innerHTML = 30;
  }
    //start
    gameField.addEventListener('input', function() {
      if (!timer) {
        startTime = Date.now();
        let timeLeft = 30;

        timer = setInterval(function() {
          timeLeft -= 1;
          if (shuffle) {
            document.getElementById("timer").innerHTML = timeLeft;
            if (timeLeft <= 0) {
              clearInterval(timer);
              document.getElementById("timer").innerHTML = 0;
              gameField.value = "";
              gameField.disabled = true;
              let wordsTyped = Math.round(correct / 5);
              let endTime = Date.now();
              let minutes = (endTime - startTime) / 60000;
              let wpm = Math.round(((wordsTyped / minutes) * 100) / 100);
              document.getElementById("game-messages").innerHTML = "Words per minute: " + wpm;
              document.getElementById("gameovertext").innerHTML = 'Tab + Enter to restart';
            } else {
              document.getElementById("timer").innerHTML = timeLeft;
              if (timeLeft < 6) { turnRed('timer'); turnWhite('timer'); }
            }
          }
          else {

          }

        }, 1000);
      }
    });
  }
document.getElementById("game-messages").innerHTML = words[currentWordIndex];

function checkInput() {
  var gameField = document.getElementById("gameField");
  var input = gameField.value;
  if (input[input.length - 1] === " ") {
    //next word
    if (input.trim() === words[currentWordIndex]) {
      gameField.value = "";
      input = "";
      document.getElementById("game-messages").children[currentWordIndex].style.display = 'none'; //hide the correct word
      currentWordIndex++;
      correct++;
      currentCharIndex = 0;
      if (currentWordIndex < words.length) {
        document.getElementById("game-messages").children[currentWordIndex].classList.add("current-word");
        gameField.size = words[currentWordIndex].length; //set size
      } else {
        //game over
        if(!shuffle) {
        let wordsTyped = Math.round(correct / 5);
        let endTime = Date.now();
        let minutes = (endTime - startTime) / 60000;
        let wpm = Math.round(((wordsTyped / minutes) * 100) / 100);
        document.getElementById("game-messages").innerHTML = "Words per minute: " + wpm;
        document.getElementById("gameovertext").innerHTML = 'Tab + Enter to restart';
        }else{
        document.getElementById("game-messages").innerHTML = "Cheater !!";
        }
      }
    } else {
      //display error
      flashRed('game-messages');
    }
  } else if (input.length < currentCharIndex) {
    currentCharIndex--;
  } else if (input[input.length - 1] !== words[currentWordIndex].charAt(currentCharIndex)) {
    //display error
    flashRed('game-messages');
  } else {
    currentCharIndex++;
        let wordElement = document.getElementById("game-messages").children[currentWordIndex];
        let correctChars = wordElement.textContent.substring(0, currentCharIndex);
        let remainingChars = wordElement.textContent.substring(currentCharIndex);
        wordElement.innerHTML = `<span class="correct-current-chars">${correctChars}</span>${remainingChars}`;
    correct++;
  }
}