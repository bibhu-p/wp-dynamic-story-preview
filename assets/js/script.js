document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".dsp-read-more").forEach(button => {
        button.addEventListener("click", function (e) {
            let contentDiv = this.closest(".dsp-preview");
            let fullContent = contentDiv?.getAttribute("data-full-content");
            if (fullContent) {
                e.preventDefault();
                let effect = this.getAttribute("data-effect");

                if (effect === "slide") {
                    contentDiv.innerHTML = fullContent;
                    contentDiv.style.maxHeight = contentDiv.scrollHeight + "px";
                    contentDiv.style.transition = "max-height 0.5s ease-in-out";
                } else if (effect === "fade") {
                    contentDiv.style.opacity = 0;
                    setTimeout(() => {
                        contentDiv.innerHTML = fullContent;
                        contentDiv.style.opacity = 1;
                        contentDiv.style.transition = "opacity 0.5s ease-in-out";
                    }, 200);
                } else {
                    contentDiv.innerHTML = fullContent;
                }
            }
        });
    });
});
