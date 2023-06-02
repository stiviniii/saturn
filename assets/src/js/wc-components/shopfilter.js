// document.addEventListener("DOMContentLoaded", function () {
//   var filterToggle = document.getElementById("filterToggle");
//   var allShade = document.getElementById("allShade");
//   var slideSidebar = document.querySelector(".slide-sidebar");

//   // Check if slide-sidebar element exists
//   if (slideSidebar) {
//     var closeIcon = slideSidebar.querySelector(".close-icon");

//     filterToggle.addEventListener("click", function () {
//       // Add the "active" class to the allShade div
//       allShade.classList.add("allShade");

//       // Add the "active" class to the slide-sidebar
//       slideSidebar.classList.add("active");
//     });

//     closeIcon.addEventListener("click", function () {
//       // Remove the "active" class from slide-sidebar
//       slideSidebar.classList.remove("active");

//       // Remove the "active" class from allShade div
//       allShade.classList.remove("allShade");
//     });

//     document.addEventListener("click", function (event) {
//       // Check if the clicked element is outside the slide-sidebar and filterToggle
//       if (
//         !slideSidebar.contains(event.target) &&
//         event.target !== filterToggle
//       ) {
//         // Remove the "active" class from slide-sidebar
//         slideSidebar.classList.remove("active");

//         // Remove the "active" class from allShade div
//         allShade.classList.remove("allShade");
//       }
//     });
//   }
// });

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
