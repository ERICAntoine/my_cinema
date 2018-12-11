const getSpan = document.getElementsByClassName('review');
const pageLoginChange = document.getElementsByClassName('change')[0];
const cardChange = document.getElementsByClassName('card_change')[1];
const reviewChange = document.getElementsByClassName("review_change");
const inputChange = document.getElementsByClassName("input_change");
const overlay = document.getElementById("overlay");
const cloneCard = cardChange.cloneNode(true);
const input = cloneCard.getElementsByTagName("input")[0];
const input2 = cloneCard.getElementsByTagName("input")[1];
const label = cloneCard.getElementsByTagName("label")[0];
const labelReview = cloneCard.getElementsByTagName("label")[1];
const lastLabel = cloneCard.getElementsByTagName("label")[2];
const textarea = cloneCard.getElementsByTagName("textarea")[0];
const formReview = cloneCard.getElementsByTagName("form")[0];
const inputHidden = document.createElement('input');

inputHidden.setAttribute("type", "hidden");
inputHidden.setAttribute("name", "nameIdFilm");
input.parentNode.removeChild(input);
input2.parentNode.removeChild(input2);
label.parentNode.removeChild(label);
labelReview.innerText = "Review:";
lastLabel.parentNode.removeChild(lastLabel);
textarea.setAttribute("name", "textReview");
textarea.setAttribute("value", "textReview");
cardChange.style.display = "none";

for(var i = 0; i < getSpan.length; i++)
{
    const span = getSpan[i];
    span.onclick = (e) =>
    {
        overlay.style.display = "block";
        cloneCard.classList.add("active");
        cloneCard.style.position = "fixed";
        cloneCard.style.borderRadius = "20px";
        pageLoginChange.parentNode.insertBefore(cloneCard, pageLoginChange);
        inputHidden.setAttribute("value", span.getAttribute("value"));
        formReview.appendChild(inputHidden);
    }        
}


overlay.onclick = (e) =>
{
    overlay.style.display = "none";
    overlay.innerHTML = "";
    document.body.removeChild(cloneCard);
}

