"use strict";

document.addEventListener("DOMContentLoaded", () => {
  const filterToggle = document.getElementById("filterToggle");
  const allShade = document.getElementById("allShade");
  const slideSidebar = document.querySelector(".slide-sidebar");

  // Check if slide-sidebar element exists
  if (slideSidebar) {
    const closeIcon = slideSidebar.querySelector(".close-icon");

    const toggleFilter = () => {
      slideSidebar.classList.toggle("active");
      allShade.classList.toggle("allShade");
      filterToggle.setAttribute(
        "aria-expanded",
        slideSidebar.classList.contains("active")
      );
    };

    const handleClickOutside = (event) => {
      if (
        !slideSidebar.contains(event.target) &&
        !filterToggle.contains(event.target)
      ) {
        slideSidebar.classList.remove("active");
        allShade.classList.remove("allShade");
        filterToggle.setAttribute("aria-expanded", false);
      }
    };

    filterToggle.addEventListener("click", toggleFilter);
    closeIcon.addEventListener("click", toggleFilter);
    document.addEventListener("click", handleClickOutside);
  }
});
