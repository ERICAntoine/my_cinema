const button = document.getElementById("delete");
const checkbox = document.getElementById("hidden");

function checkACheckbox(checkbox, button)
{
    button.onclick = (e) =>
    {
        e.preventDefault();
        
        if(checkbox.checked == false)
        {
            const conf = confirm("Voulez vous vraiment supprimer cette Abonnment");
            if(conf == true)
            {
                checkbox.checked = true;
            }
        }
        else
        {
            const conf = confirm("Votre choix sera anulle");
            if(conf == true)
            {
                checkbox.checked = false;
            }
        }
    }
}

checkACheckbox(checkbox, button);


const selectAbonnement = document.getElementById("abonnement");

function selectedAbonnement(select)
{
    select.addEventListener("change", function (e) {
        e.preventDefault();
        const option = select.options[select.selectedIndex].text;
        const conf = confirm("Voulez-vous vraiment changer votre abonnement par " + option);
    });
}

selectedAbonnement(selectAbonnement);