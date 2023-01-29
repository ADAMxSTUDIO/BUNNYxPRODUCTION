var form = document.getElementsByTagName("form");
                from.style = "display:none;";
                var connexion = document.getElementsByClassName("connexion");
                var paragraph = document.createElement("p");
                paragraph.innerHTML = "Welcome, $_COOKIE["username"]";
                connexion.appendChild(paragraph);
                