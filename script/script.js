/*jshint esversion: 6 */

const darkThemeMq = window.matchMedia("(prefers-color-scheme: dark)");
if (localStorage.light == undefined) {
    if (darkThemeMq.matches) {
        localStorage.setItem("light", 0);
    } else {
        localStorage.setItem("light", 1);
    }
}

var formatter = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
});

var stuff;

function themeLoader() {
    if (localStorage.light == 1) {
        document.getElementById("theme").href = "/style/style-light.css";
    } else {
        document.getElementById("theme").href = "/style/style-dark.css";
    }
}

function themeChanger() {
    if (localStorage.light == 0) {
        document.getElementById("theme").href = "/style/style-light.css";
        localStorage.light++;
    } else {
        document.getElementById("theme").href = "/style/style-dark.css";
        localStorage.light = 0;
    }
    return localStorage.light;
}

function revealPassword(btn) {
    var pass = document.getElementById('password');
    console.log(pass);
    if (pass.type == 'password') {
        pass.type = 'text';
        btn.setAttribute('src', '/img/unreveal.png');
        btn.setAttribute('alt', 'unreveal');
    } else {
        pass.type = 'password';
        btn.setAttribute('src', '/img/reveal.png');
        btn.setAttribute('alt', 'reveal');
    }
}

var menuOpen = false;

function openMenu() {
    document.querySelector('.menu-btn').classList.add('open');
    document.querySelector('nav ul').classList.add('show');
}

function closeMenu() {
    document.querySelector('.menu-btn').classList.remove('open');
    document.querySelector('nav ul').classList.remove('show');
}

function menu() {
    if (menuOpen) {
        closeMenu();
        menuOpen = false;
    } else {
        openMenu();
        menuOpen = true;
    }
}

var displayLogin = false;

function showLogin() {
    document.querySelector(".blur").style.display = "flex";
    document.querySelector("body").style.overflow = "hidden";
}

function hideLogin() {
    document.querySelector(".blur").style.display = "none";
    document.querySelector("body").style.overflow = "auto";
}

function loadMovies() {
    var card = document.querySelector('.card-wrapper');
    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            card.innerHTML = "";
            try {
                const myObj = JSON.parse(this.responseText);
                for (let i = 0; i < myObj.length; i++) {
                    let rate = Number(myObj[i].rate).toFixed(1);
                    card.innerHTML += "<div class='card'>" + "<div class='card-img'>" + "<img src='" + 
                    myObj[i].image_url + "' alt='"+ myObj[i].title + "'>" + "</div>" + "<div class='card-title'><a href='/movie_detail.php?id=" + myObj[i].movieId + "'>" +  myObj[i].title + "</a></div>" + "<div class='card-year'>" + myObj[i].year + "</div>" +
                    "<div class='card-rating' id='" + myObj[i].movieId + "'>"+
                        "<i class='fa-solid fa-star'></i>" +
                        "<i class='fa-solid fa-star'></i>" +
                        "<i class='fa-solid fa-star'></i>" +
                        "<i class='fa-solid fa-star'></i>" +
                        "<i class='fa-solid fa-star'></i>" +
                    "</div>" + "<div class='card-rate'>" + rate + "</div>" + "</div>";
                    document.getElementById(myObj[i].movieId).style.backgroundSize = `${rate/5*100}% 100%`;
                }
            } catch (e) {
                alert("Data tidak berhasil dimuat");
            }
        }
    };
    xhttp.open("GET", "/data/movies_get.php", true);
    xhttp.send();
}

function searchMovies(str) {
    var card = document.querySelector('.card-wrapper');
    if (str.length == 0) {
        loadMovies();
        return;
    }

    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('result').innerHTML = "";

            try {
                const myObj = JSON.parse(this.responseText);
                for (let i = 0; i < myObj.length; i++) {
                    let rate = Number(myObj[i].rate).toFixed(1);
                    card.innerHTML += "<div class='card'>" + "<div class='card-img'>" + "<img src='" + 
                    myObj[i].image_url + "' alt='"+ myObj[i].title + "'>" + "</div>" + "<div class='card-title'><a href='/movie_detail.php?id=" + myObj[i].movieId + "'>" +  myObj[i].title + "</a></div>" + "<div class='card-year'>" + myObj[i].year + "</div>" +
                    "<div class='card-rating' id='" + myObj[i].movieId + "'>"+
                        "<i class='fa-solid fa-star'></i>" +
                        "<i class='fa-solid fa-star'></i>" +
                        "<i class='fa-solid fa-star'></i>" +
                        "<i class='fa-solid fa-star'></i>" +
                        "<i class='fa-solid fa-star'></i>" +
                    "</div>" + "<div class='card-rate'>" + rate + "</div>" + "</div>";
                    document.getElementById(myObj[i].movieId).style.backgroundSize = `${rate/5*100}% 100%`;
                }
            }
            catch (e) {
                document.getElementById('result').innerHTML = this.responseText;
                console.log(e);
            }
        }
    };
    xhttp.open("GET", "/data/search_movies.php?keyword=" + str, true);
    xhttp.send();
}

function changeSearch(obj) {
    document.getElementById('search').value = obj;
    document.getElementById('suggestion').innerHTML = "";
    searchMovies(obj);
}

function suggestMovies(str) {
    var suggestionBox = document.getElementById('suggestion');

    if (str.length == 0) {
        suggestionBox.innerHTML = "";
        return;
    }

    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            suggestionBox.innerHTML = "";

            try {
                suggestionBox.innerHTML = "";
                const myObj = JSON.parse(this.responseText);
                for (let i = 0; i < myObj.length; i++) {
                    suggestionBox.innerHTML += "<li onclick='changeSearch(this.innerHTML)'>"+ myObj[i].title +"</li>";
                }
            }
            catch (e) {
                suggestionBox.innerHTML = this.responseText;
                console.log(e);
            }
        }
    };
    xhttp.open("GET", "/data/suggest_movies.php?keyword=" + str, true);
    xhttp.send();
}


var error = [[],[],[],[],[]];

function validateName() {
    var nameLabel = document.getElementById('name-label');
    var name = document.getElementById('name').value;

    if (!/[^a-zA-Z ]/.test(name)) {
        if (name.length < 3) {
            error[0][0] = true;
            error[0][1] = nameLabel;
            nameLabel.innerHTML = "*Nama minimal 3 huruf";
            nameLabel.style.color = "red";
        } else {
            error[0][0] = false;
            nameLabel.innerHTML = "Name";
            nameLabel.style.color = "black";
        }
    } else {
        error[0][0] = true;
        error[0][1] = nameLabel;
        nameLabel.innerHTML = "*Nama harus berupa huruf";
        nameLabel.style.color = "red";
    }
}

function validatePhone() {
    var phoneLabel = document.getElementById('phone-label');
    var phone = document.getElementById('phone').value;

    if (!/[^0-9]/.test(phone)) {
        if (phone.length < 8 || phone.length > 15) {
            error[1][0] = true;
            error[1][1] = phoneLabel;
            phoneLabel.innerHTML = "*Nomor telepon minimal 8 digit dan maksimal 15 digit";
            phoneLabel.style.color = "red";
        } else {
            error[1][0] = false;
            phoneLabel.innerHTML = "Phone";
            phoneLabel.style.color = "black";
        }
    } else {
        error[1][0] = true;
        phoneLabel.innerHTML = "*Nomor telepon harus berupa angka";
        phoneLabel.style.color = "red";
    }
}

function validateUsername() {
    var usernameLabel = document.getElementById('usrnm-label');
    var username = document.getElementById('usrnm').value;

    if (username.length > 20 || username.length < 5) {
        error[2][0] = true;
        error[2][1] = usernameLabel;
        usernameLabel.innerHTML = "*Username harus 5-20 karakter";
        usernameLabel.style.color = "red";
    } else if (/[^a-zA-Z&0-9]/.test(username)) {
        error[2][0] = true;
        error[2][1] = usernameLabel;
        usernameLabel.innerHTML = "*Username harus berupa huruf dan angka";
        usernameLabel.style.color = "red";
    } else {
        error[2][0] = false;
        usernameLabel.innerHTML = "Username";
        usernameLabel.style.color = "black";
    }
}

function validatePassword() {
    var passwordLabel = document.getElementById('pwd-label');
    
    var password = document.getElementById('pwd').value;

    if (password.length < 8) {
        error[3][0] = true;
        error[3][1] = passwordLabel;
        passwordLabel.innerHTML = "*Password minimal 8 karakter";
        passwordLabel.style.color = "red";
    }  else if (/[^a-zA-Z&0-9&*&-&_]/.test(password)) {
        error[3][0] = true;
        error[3][1] = passwordLabel;
        passwordLabel.innerHTML = "*Password harus berupa huruf, angka, dan simbol (* atau - atau _)";
        passwordLabel.style.color = "red";
    } else {
        error[3][0] = false;
        passwordLabel.innerHTML = "Password";
        passwordLabel.style.color = "black";
    }
}

function validatePasswordConfirm() {
    var password = document.getElementById('pwd').value;
    var confirmPasswordLabel = document.getElementById('pwd-confirm-label');
    var confirmPassword = document.getElementById('pwd-confirm').value;

    if (password != confirmPassword) {
        error[4][0] = true;
        error[4][1] = confirmPasswordLabel;
        confirmPasswordLabel.innerHTML = "*Password harus sama";
        confirmPasswordLabel.style.color = "red";
    } else {
        error[4][0] = false;
        confirmPasswordLabel.innerHTML = "Confirm Password";
        confirmPasswordLabel.style.color = "black";
    }
}

function validationRegistration() {
    event.preventDefault();

    var stillError = true;
    for (let i = 0; i < 5; i++) {
        if (error[i][0]) {
            stillError = true;
            error[i][1].scrollIntoView();
            break;
        } else {
            stillError = false;
        }
    }
    if (!stillError) {
        document.getElementById('regis-form').submit();
    }
}

function showModal() {
    var modal = document.querySelector(".modal");
    var root = document.querySelector("body");
    
    modal.style.display = "flex";
    root.style.overflow = "hidden";
}

function hideModal() {
    var modal = document.querySelector(".modal");
    var root = document.querySelector("body");
    
    modal.style.display = "none";
    root.style.overflow = "auto";
}

function loadStuff() {
    var card = document.querySelector('.stuff-wrapper');
    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            card.innerHTML = "";
            try {
                const myObj = JSON.parse(this.responseText);
                stuff = myObj;
                  
                for (let i = 0; i < myObj.length; i++) {
                    card.innerHTML += '<div class="stuff" onclick="document.location.href = \'/stuff_detail?id=' + myObj[i].idStuff + '\'">' +
                    '<div class="stuff-image">' +
                        '<img src="' + myObj[i].image_url + '" alt="' + myObj[i].nama_barang + '">' +
                    '</div>' +
                    '<div class="stuff-text">' +
                        '<div class="stuff-title">' + myObj[i].nama_barang.substr(0,35) + '</div>' +
                        '<div class="stuff-price">' + formatter.format(myObj[i].harga) + '</div>' +
                    '</div>' +
                    '</div>';
                }
                document.getElementById("sterpopuler").classList.add("active");
            } catch (e) {
                alert("Data tidak berhasil dimuat");
            }
        }
    };
    xhttp.open("GET", "/data/stuff_get.php", true);
    xhttp.send();
}


function suggestStuff(str) {
    var suggestionBox = document.getElementById('suggestion');

    if (str.length == 0) {
        suggestionBox.innerHTML = "";
        return;
    }

    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            suggestionBox.innerHTML = "";

            try {
                suggestionBox.innerHTML = "";
                const myObj = JSON.parse(this.responseText);
                for (let i = 0; i < myObj.length; i++) {
                    suggestionBox.innerHTML += "<li onclick='changeSearchStuff(this)'>"+ myObj[i].nama_barang +"</li>";
                }
            }
            catch (e) {
                suggestionBox.innerHTML = this.responseText;
                console.log(e);
            }
        }
    };
    xhttp.open("GET", "/data/suggest_stuff.php?keyword=" + str, true);
    xhttp.send();
}

function changeSearchStuff(obj) {
    document.getElementById('search').value = obj.innerText;
    document.getElementById('suggestion').innerHTML = "";
    searchStuff(obj.innerText);
}

function searchStuff(str) {
    var card = document.querySelector('.stuff-wrapper');
    if (str.length == 0) {
        loadStuff();
        return;
    }

    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('result').innerHTML = "";

            try {
                const myObj = JSON.parse(this.responseText);
                stuff = myObj;
                for (let i = 0; i < myObj.length; i++) {
                    card.innerHTML += '<div class="stuff" onclick="document.location.href = \'/stuff_detail?id=' + myObj[i].idStuff + '\'">' +
                    '<div class="stuff-image">' +
                        '<img src="' + myObj[i].image_url + '" alt="' + myObj[i].nama_barang + '">' +
                    '</div>' +
                    '<div class="stuff-text">' +
                        '<div class="stuff-title">' + myObj[i].nama_barang.substr(0,35) + '</div>' +
                        '<div class="stuff-price">' + formatter.format(myObj[i].harga) + '</div>' +
                    '</div>' +
                    '</div>';
                }
                document.getElementById("snamaasc").classList.remove("active");
   				document.getElementById("snamadesc").classList.remove("active");
    			document.getElementById("sterbaru").classList.remove("active");
    			document.getElementById("sterlama").classList.remove("active");
    			document.getElementById("stermurah").classList.remove("active");
    			document.getElementById("stermahal").classList.remove("active");
    			document.getElementById("sterpopuler").classList.remove("active");
            	document.getElementById("sterpopuler").classList.add("active");
            }
            catch (e) {
                document.getElementById('result').innerHTML = this.responseText;
                console.log(e);
            }
        }
    };
    xhttp.open("GET", "/data/search_stuff.php?keyword=" + str, true);
    xhttp.send();
}

function sortStuff(sortBy, obj) {
    var card = document.querySelector('.stuff-wrapper');
    card.innerHTML = "";
    document.getElementById("snamaasc").classList.remove("active");
    document.getElementById("snamadesc").classList.remove("active");
    document.getElementById("sterbaru").classList.remove("active");
    document.getElementById("sterlama").classList.remove("active");
    document.getElementById("stermurah").classList.remove("active");
    document.getElementById("stermahal").classList.remove("active");
    document.getElementById("sterpopuler").classList.remove("active");

    function loadSortStuff() {          
        for (let i = 0; i < stuff.length; i++) {
            card.innerHTML += '<div class="stuff">' +
            '<div class="stuff-image" onclick="document.location.href = \'/stuff_detail?id=' + stuff[i].idStuff + '\'">' +
                '<img src="' + stuff[i].image_url + '" alt="' + stuff[i].nama_barang + '">' +
            '</div>' +
            '<div class="stuff-text">' +
                '<div class="stuff-title">' + stuff[i].nama_barang.substr(0,35) + '</div>' +
                '<div class="stuff-price">' + formatter.format(stuff[i].harga) + '</div>' +
            '</div>' +
            '</div>';
        }
    }

    if (sortBy == "namaasc") {
        stuff.sort(function(a, b) {
            return a.nama_barang.localeCompare(b.nama_barang);
        });
    } else if (sortBy == "namadesc") {
        stuff.sort(function(a, b) {
            return b.nama_barang.localeCompare(a.nama_barang);
        });
    } else if (sortBy == "terbaru") {
        stuff.sort(function(a, b) {
            return b.idStuff - a.idStuff;
        });
    } else if (sortBy == "termurah") {
        stuff.sort(function(a, b) {
            return a.harga - b.harga;
        });
    } else if (sortBy == "termahal") {
        stuff.sort(function(a, b) {
            return b.harga - a.harga;
        });
    } else if (sortBy == "terlama") {
        stuff.sort(function(a, b) {
            return a.idStuff - b.idStuff;
        });
    } else if (sortBy == "populer") {
        stuff.sort(function(a, b) {
            return b.views - a.views;
        });
    }
    loadSortStuff();
    obj.classList.add("active");
}

function hapusReview(idReview, idMovie) {
    if (confirm("Apakah Anda yakin ingin menghapus review ini?")) {
        document.location.href = `/data/delete_review.php?id=${idReview}&movieId=${idMovie}`;
    }
}

function hapusStuff(idStuff) {
    if (confirm("Apakah Anda yakin ingin menghapus barang ini?")) {
        document.location.href = `/data/delete_stuff.php?id=${idStuff}`;
    }
}

function changePicture() {
    var screenShot = document.getElementById("screenshot");
    var i = 1;

    setInterval(function() {
        i++;
        if (i > 2)
            i = 1;
        screenShot.src = `/img/product-${i}.png`;
    }, 10000);
}