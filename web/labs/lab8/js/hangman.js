var selectedWord = "";
var selectedHint = "";
var board = [];
var remainingGuess = 6;
var hintRevealed = false;
var words = [{word: "snake", hint: "It's a reptile"},
             {word: "monkey", hint: "It's a mammal"},
             {word: "beetle", hint: "It's an insect"}];

var wordsDiscovered = new Array();
// Creating an array of available letters
var alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 
                'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 
                'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];


window.onload = startGame();

function startGame()
{
    pickWord();
    initBoard();
    updateBoard();
    createLetters();
    //displayHintBtn();
}

$(".letter").click(function()
{
    checkLetter($(this).attr("id"));
    disableButton($(this));
});
$(".replayBtn").on("click", function()
{
    //location.reload();
    restartGame();
});

$(document).on("click", '.hint',function()
{
    displayHint();
    remainingGuess -= 1;
    updateMan();
    hintRevealed = true;
    console.log("Clicked on Hint");
    $(".hint").hide();
});
function restartGame()
{
    selectedHint = "";
    selectedWord = "";
    remainingGuess = 6;
    board = [];
    hintRevealed = false;
    $("#letters").show();
    //$("#letters").empty();
    $('#won').hide();
    $('#lost').hide();
    pickWord();
    initBoard();
    updateBoard();
    resetLetter();
    resetMan();
    //displayHintBtn();
    //startGame();
}
function resetLetter()
{
    var btnLetters = document.getElementsByClassName("letter");
    for (var i = 0; i < btnLetters.length; i++)
    {
        btnLetters[i].removeAttribute("disabled");
        btnLetters[i].getAttributeNode("class").value = "letter btn btn-success";
    }
}
function pickWord()
{
    var randomInt = Math.floor(Math.random() * words.length);
    selectedWord = words[randomInt].word.toUpperCase();
    selectedHint = words[randomInt].hint;
}
function initBoard()
{
    for (var letter in selectedWord)
    {
        board.push("_");
    }
}
function updateBoard()
{
    $("#word").empty();
    for (var i = 0; i < board.length; i++)
    {
        //document.getElementById("word").innerHTML += letter + " ";
        $("#word").append(board[i] + " ");
    }
    $("#word").append("<br />");
    if (hintRevealed) displayHint();
    else displayHintBtn();
}
function displayHintBtn()
{
    $("#word").append("<button class='hint btn btn-warning' id='hint'>Hint</button>");
}
function displayHint()
{
    $("#word").append("<span class=''>Hint: " + selectedHint + "</span>");
}
function createLetters()
{
    for (var letter of alphabet)
    {
        $("#letters").append("<button class='letter btn btn-success' id='" + letter + "'>" + letter + "</button>");
    }
}
function checkLetter(letter)
{
    var positions = new Array();
    
    for (var i = 0; i < selectedWord.length; i++)
    {
        //console.log(selectedWord);
        if (letter == selectedWord[i])
        {
            positions.push(i);
        }
    }
    if (positions.length > 0)
    {
        updateWord(positions, letter);
        if (!board.includes('_'))
        {
            endGame(true);
        }
    }
    else 
    {
        remainingGuess -= 1;
        updateMan();
    }
    if (remainingGuess <= 0)
    {
        endGame(false);
    }
}
function updateWord(positions, letter)
{
    for (var pos of positions)
    {
        board[pos] = letter;
    }
    updateBoard();
}
function updateMan()
{
    $("#hangImg").attr("src", "img/stick_" + (6 - remainingGuess) + ".png");
}
function resetMan()
{
    $("#hangImg").attr("src", "img/stick_0.png");
}
function endGame(win)
{
    $("#letters").hide();
    
    if(win) 
    {
        $('#won').show();
        wordsDiscovered.push(selectedWord);
    }
    else 
    {
        $('#lost').show();
    }
    displayDiscoveredWord();
}
function disableButton(btn)
{
    btn.prop("disabled", true);
    btn.attr("class", "letter btn btn-danger");
}
function displayDiscoveredWord()
{
    if (wordsDiscovered.length > 0)
    {
        $('#discoveredWords').empty();
        $('#discoveredWords').append("<h2>Discovered Words</h2>");
        $('#discoveredWords').append("<ul>");
        for (var i = 0; i < wordsDiscovered.length; i++)
        {
            $('#discoveredWords').append("<li>" + wordsDiscovered[i] + "</li>");
        }
        $('#discoveredWords').append("</ul>");
    }
}