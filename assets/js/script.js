document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".dsp-read-more").forEach(button => {
        button.addEventListener("click", function (e) {
            if (this.getAttribute("href") === "#") {
                e.preventDefault();
                let contentDiv = this.closest(".dsp-preview");
                let fullContent = contentDiv.getAttribute("data-full-content");
                contentDiv.innerHTML = fullContent;
            }
        });
    });
});