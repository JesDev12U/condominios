const navbarLinks = document.querySelectorAll(".nav-link");

navbarLinks.forEach((link) => {
  link.addEventListener("click", function (e) {
    if (this.getAttribute("id") === "login") return;
    e.preventDefault();
    const targetId = this.getAttribute("href").substring(1);
    const targetElement = document.getElementById(targetId);
    const offset = 100;
    const elementPosition = targetElement.getBoundingClientRect().top;
    const offsetPosition = elementPosition - offset;

    window.scrollBy({
      top: offsetPosition,
      behavior: "smooth",
    });
  });
});
