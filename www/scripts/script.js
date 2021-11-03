document.addEventListener('DOMContentLoaded', (event) => {
    new MiniLazyload({
        rootMargin: "500px",
        placeholder: "https://imgplaceholder.com/420x320/ff7f7f/333333/fa-image"
    }, ".lazyload", MiniLazyload.IGNORE_NATIVE_LAZYLOAD)


    /* NAV */
    let navBarsButton = document.getElementById("navBarsButton");
    let nav = document.querySelector("nav");
    let isNavVisible = false;

    navBarsButton.addEventListener("click", showNav);

    function showNav() {
        if (!isNavVisible) {
            nav.classList.add("navShown");
            isNavVisible = true
        } else {
            nav.classList.remove("navShown");
            isNavVisible = false;
        }
    }

    /* HIGHLIGHTS */
    let highlightLeftButton = document.getElementById("highlightsLeftButton");
    let highlightRightButton = document.getElementById("highlightsRightButton");
    let highlights = document.querySelectorAll(".highlights a");
    let highlightsStartIndex = 0
    let highlightsOnPage;
    if (highlightLeftButton) {
        highlightLeftButton.addEventListener("click", changeHighlightsStartIndex.bind(false, null), false);
        highlightRightButton.addEventListener("click", changeHighlightsStartIndex, false);
        window.addEventListener("resize", showHighlights);
    }

    function showHighlights() {
        highlightsOnPage = window.innerWidth <= 400 ? 2 : (window.innerWidth <= 552 ? 3 : (window.innerWidth <= 880 ? 4 : 7));
        let highlightCounter = 0;
        for (let i = 0; i < highlights.length; i++) {
            if (i >= highlightsStartIndex && highlightCounter < highlightsOnPage) {
                highlights[i].style.display = "block";
                highlightCounter++;
            } else {
                highlights[i].style.display = "none";
            }
        }

        if (highlightsStartIndex > highlights.length - (highlightsOnPage + 1)) {
            highlightRightButton.style.display = "none";
        } else {
            highlightRightButton.style.display = "block";
        }
        if (highlightsStartIndex < highlightsOnPage - (highlightCounter - 1)) {
            highlightLeftButton.style.display = "none";
        } else {
            highlightLeftButton.style.display = "block";
        }
    }

    function changeHighlightsStartIndex(toTheRight = true) {
        if (toTheRight) {
            highlightsStartIndex += highlightsOnPage;
        } else {
            highlightsStartIndex -= highlightsOnPage;
        }
        showHighlights();
    }

    /* DIALOG */
    let photoDialog = document.getElementById("photoDialog");
    let photos = document.querySelectorAll("article .image");
    let imagesRightButton = document.getElementById("imagesRightButton");
    let imagesLeftButton = document.getElementById("imagesLeftButton");
    let displayedImage = document.querySelector("#photoDialog img");
    let imgDiv = document.querySelector(".photoInfo");
    let closeDialogButton = document.getElementById("closeDialogButton")

    if (photoDialog) {
        for (let photo of photos) {
            photo.addEventListener("click", showImageDialog.bind(false, photo.id));
            photo.addEventListener("click", setImageText.bind(false, photo.getAttribute("img-info-id")));
        }
        photoDialog.addEventListener("click", closeImageDialog);
        imagesLeftButton.addEventListener("click", e => e.stopPropagation());
        imagesRightButton.addEventListener("click", e => e.stopPropagation());
        imgDiv.addEventListener("click", e => e.stopPropagation());
        imagesRightButton.addEventListener("click", changeImageInDialog);
        imagesLeftButton.addEventListener("click", changeImageInDialog.bind(false, false));
        displayedImage.addEventListener("click", changeImageInDialog);
        document.addEventListener("keydown", changeImageOnKey)
        closeDialogButton.addEventListener("click", closeImageDialog);
    }
    if (photoDialog) {
        photoDialog.close();
    }
    function showImageDialog(photoId) {
        //if (typeof photoDialog.showModal === "function") {
            displayedImage.src = document.getElementById(photoId).src.replace(/thumbnail/, "fullview");
            displayedImage.id = photoId;
            //photoDialog.showModal()
            photoDialog.style.display = "flex";
        /*} else {
            alert("The <dialog> API is not supported by this browser");
        }*/
    }

    function closeImageDialog() {
        //photoDialog.close();
        photoDialog.style.display = "none";
    }

    function changeImageOnKey(e) {
        if (e.keyCode === 37) {
            changeImageInDialog(false);
        } else if (e.keyCode === 39) {
            changeImageInDialog(true);
        } else if (e.keyCode === 27) {
            closeImageDialog();
        }
    }

    function changeImageInDialog(toTheRight = true) {
        let id;
        let currentImageId = parseInt(displayedImage.id.match(/\d+$/)[0]);
        let idNumbers = [];
        for (let img of photos) {
            idNumbers.push(parseInt(img.id.match(/\d+$/)[0]));
        }
        if (toTheRight) {
            if (currentImageId >= Math.max(...idNumbers)) {
                currentImageId = 0;
            } else {
                currentImageId++;
            }
        } else {
            if (currentImageId <= 0) {
                currentImageId = Math.max(...idNumbers);
            } else {
                currentImageId--;
            }
        }
        id = "image_" + currentImageId;
        displayedImage.id = id;
        displayedImage.src = document.getElementById(id).src.replace(/thumbnail/, "fullview");
        setImageText(document.getElementById(id).getAttribute("img-info-id"))
    }

    function setImageText(imageId) {
        axios.get('/handle/getImageText', {
            params: {
                "imageId": imageId,
            }
        })
            .then(function (response) {
                setImageTextDom(response.data.response);
            })
            .catch(function (error) {
                setImageTextDom(null, false)
            })
            .then(function () {
                // always executed
            });
    }

    function setImageTextDom(response, iserr = true) {
        if (iserr) {
            document.querySelector("#photoDialog .info h3").textContent = response.title;
            document.querySelector("#photoDialog .info p").textContent = response.description;
        } else {
            document.querySelector("#photoDialog .info h3").textContent = "";
            document.querySelector("#photoDialog .info p").textContent = "";
        }
    }



    showHighlights();
})