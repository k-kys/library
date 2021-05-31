const UPLOAD_BUTTON = document.getElementById("upload-button");
// const FILE_INPUT = document.querySelector("input[type=file]");
const FILE_INPUT = document.getElementById("image");
const IMG = document.getElementById("img");

UPLOAD_BUTTON.addEventListener("click", () => FILE_INPUT.click());

FILE_INPUT.addEventListener("change", (event) => {
    const file = event.target.files[0];

    const reader = new FileReader();
    reader.readAsDataURL(file);

    reader.onloadend = (e) => {
        IMG.setAttribute("aria-label", file.name);
        // IMG.style.background = `url(${reader.result}) center center/cover`;
        IMG.src = e.target.result;
    };
});