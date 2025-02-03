
<script>
    function openNewTab(url) {
        if (!url || typeof url !== 'string') {
            console.error('Invalid URL');
            return;
        }
        
        const newTab = window.open(url, '_blank');
        
        if (!newTab) {
            console.error('Popup blocked. Please allow popups for this site.');
        }
    }
</script>
<script>
    function tagsel(tag){
        
        console.log(tag);
    }
</script>
<script>
    function groupsel(group){
        console.log(group);
    }

</script>



<script>

function filterButtons(filtertag) {
    // Get all button elements
    const buttons = document.querySelectorAll("button");
    
    // Iterate over each button
    buttons.forEach(button => {
        // Get the tags attribute
        const tags = button.getAttribute("tags");
        
        if (!tags) return;
        
        // Split tags into an array using '|' as a separator
        const tagArray = tags.split("|");
        
        // Check if filtertag is empty or exactly matches one of the tags
        if (filtertag === "" || tagArray.includes(filtertag)) {
            button.style.display = "inline-block"; // Show button
        } else {
            button.style.display = "none"; // Hide button
        }
    } ) ;
}



function filterButtonsByClass(filterclass) {
    // Get all button elements
    const buttons = document.querySelectorAll("button");
    
    // Iterate over each button
    buttons.forEach(button => {

        const tags = button.getAttribute("tags");        
        if (!tags) return;

        // Check if filterclass is empty or button contains the specified class
        if (filterclass === "" || button.classList.contains(filterclass)) {
            button.style.display = "inline-block"; // Show button
        } else {
            button.style.display = "none"; // Hide button
        }
    } ) ;
}



{literal}
    async function updateTable(table,target) {
        try {
            // Prepare the POST request payload
            const formData = new FormData();
            formData.append("seccode", "{/literal}{$seccode}{literal}");
            formData.append("section", table);
    
            // Send the POST request to api.php
            const response = await fetch("api.php", {
                method: "POST",
                body: formData
            });
    
            // Check if the response is successful
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
    
            // Get the response text (assuming it's HTML content)
            const data = await response.text();
    
            // Replace the content of the element with ID 'icontable'
            const iconTable = document.getElementById(target);
            if (iconTable) {
                iconTable.innerHTML = data;
            } else {
                console.error("Element with ID 'icontable' not found.");
            }
        } catch (error) {
            console.error("Error updating icon table:", error);
        }
    }    

    async function updateIconTable() {
        try {
            // Prepare the POST request payload
            const formData = new FormData();
            formData.append("seccode", "{/literal}{$seccode}{literal}");
            formData.append("section", "icons");
    
            // Send the POST request to api.php
            const response = await fetch("api.php", {
                method: "POST",
                body: formData
            });
    
            // Check if the response is successful
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
    
            // Get the response text (assuming it's HTML content)
            const data = await response.text();
    
            // Replace the content of the element with ID 'icontable'
            const iconTable = document.getElementById("icontable");
            if (iconTable) {
                iconTable.innerHTML = data;
            } else {
                console.error("Element with ID 'icontable' not found.");
            }
        } catch (error) {
            console.error("Error updating icon table:", error);
        }
    }





    function getUserInput(promptText, defaultValue) {
        // Prompt the user to enter text with the provided prompt and default value
        let userInput = prompt(promptText, defaultValue);

        // Check if the user pressed Cancel or left the input empty
        if (userInput === null || userInput.trim() === "") {
            // If the input is empty or Cancel is pressed, return the default value
            return defaultValue;
        }

        // Return the user input
        return userInput;
    }


    async function updateTableItem(section,target,id,oldval) {
        try {
            // Prepare the POST request payload
            const formData = new FormData();
            formData.append("seccode", "{/literal}{$seccode}{literal}");
            formData.append("section", section);
            formData.append("id", id);
            formData.append("action", "update");            

            let NewVal = getUserInput("Please enter a new value",oldval);
            formData.append("newval", NewVal);            
            


            // Send the POST request to api.php
            const response = await fetch("api.php", {
                method: "POST",
                body: formData
            });
    
            // Check if the response is successful
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
    
            // Get the response text (assuming it's HTML content)
            const data = await response.text();
    
            // Replace the content of the element with ID 'icontable'
            const iconTable = document.getElementById(target);
            if (iconTable) {
                iconTable.innerHTML = data;
            } else {
                console.error("Element with ID 'icontable' not found.");
            }
        } catch (error) {
            console.error("Error updating icon table:", error);
        }
    }

    async function deleteTableItem(section,target,id) {
        try {
            // Prepare the POST request payload
            const formData = new FormData();
            formData.append("seccode", "{/literal}{$seccode}{literal}");
            formData.append("section", section);
            formData.append("id", id);
            formData.append("action", "delete");            

            // Send the POST request to api.php
            const response = await fetch("api.php", {
                method: "POST",
                body: formData
            });
    
            // Check if the response is successful
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
    
            // Get the response text (assuming it's HTML content)
            const data = await response.text();
    
            // Replace the content of the element with ID 'icontable'
            const iconTable = document.getElementById(target);
            if (iconTable) {
                iconTable.innerHTML = data;
            } else {
                console.error("Element with ID 'icontable' not found.");
            }
        } catch (error) {
            console.error("Error updating icon table:", error);
        }
    }








    async function addTableItem(section,target) {
        try {
            // Prepare the POST request payload
            const formData = new FormData();
            formData.append("seccode", "{/literal}{$seccode}{literal}");
            formData.append("section", section);
            formData.append("action", "add");            

            let NewVal = getUserInput("Please enter a new value","");
            formData.append("newval", NewVal);            
            


            // Send the POST request to api.php
            const response = await fetch("api.php", {
                method: "POST",
                body: formData
            });
    
            // Check if the response is successful
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
    
            // Get the response text (assuming it's HTML content)
            const data = await response.text();
    
            // Replace the content of the element with ID 'icontable'
            const iconTable = document.getElementById(target);
            if (iconTable) {
                iconTable.innerHTML = data;
            } else {
                console.error("Element with ID 'icontable' not found.");
            }
        } catch (error) {
            console.error("Error updating icon table:", error);
        }
    }










{/literal}



</script>


