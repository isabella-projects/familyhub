export default class Fullheight {
    constructor(selector) {
        this.elements = document.querySelectorAll(selector);
        this.setHeight();

        window.addEventListener("resize", () => {
            this.setHeight();
        });
    }

    setHeight() {
        const windowHeight = window.innerHeight - 130;
        this.elements.forEach((element) => {
            element.style.height = windowHeight + "px";
        });
    }
}
