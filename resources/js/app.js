import "./bootstrap";
import Search from "./modules/live-search";
import Chat from "./modules/chat";
import Profile from "./modules/profile";
import Fullheight from "./modules/fullheight";

if (document.querySelector(".header-search-icon")) {
    new Search();
}

if (document.querySelector(".header-chat-icon")) {
    new Chat();
}

if (document.querySelector(".profile-nav")) {
    new Profile();
}

document.addEventListener("DOMContentLoaded", function () {
    if (document.querySelector(".fullheight")) {
        new Fullheight(".fullheight");
    }
});
