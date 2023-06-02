window.addEventListener("DOMContentLoaded", () => {
  const tabs = document.querySelectorAll('[role="tab"]');
  const tabList = document.querySelector('[role="tablist"]');

  // Add a click event handler to each tab
  tabs.forEach((tab) => {
    tab.addEventListener("click", changeTabs);
  });

  // Enable arrow navigation between tabs in the tab list
  let tabFocus = 0;

  tabList.addEventListener("keydown", (e) => {
    // Move right
    if (e.key === "ArrowRight" || e.key === "ArrowLeft") {
      tabs[tabFocus].setAttribute("tabindex", -1);
      if (e.key === "ArrowRight") {
        tabFocus++;
        // If we're at the end, go to the start
        if (tabFocus >= tabs.length) {
          tabFocus = 0;
        }
        // Move left
      } else if (e.key === "ArrowLeft") {
        tabFocus--;
        // If we're at the start, move to the end
        if (tabFocus < 0) {
          tabFocus = tabs.length - 1;
        }
      }

      tabs[tabFocus].setAttribute("tabindex", 0);
      tabs[tabFocus].focus();
    }
  });
});

// function changeTabs(e) {
//   const target = e.target;
//   const parent = target.parentNode;
//   const grandparent = parent.parentNode;
//   const grandgrand = grandparent.parentNode.parentNode;
//   // const img = grandgrand.querySelector('[role="figure"] img');
//   console.log(grandgrand);
//   // console.log(img);

//   // Remove all current selected tabs
//   parent
//     .querySelectorAll('[aria-selected="true"]')
//     .forEach((t) => t.setAttribute("aria-selected", false));

//   // Set this tab as selected
//   target.setAttribute("aria-selected", true);

//   // Hide all tab panels
//   grandparent
//     .querySelectorAll('[role="tabpanel"]')
//     .forEach((p) => p.setAttribute("hidden", true));
//   grandgrand
//     .querySelectorAll('[role="figure"]')
//     .forEach((s) => s.setAttribute("hidden", true));

//   // Show the selected panel
//   grandparent.parentNode
//     .querySelector(`#${target.getAttribute("aria-controls")}`)
//     .removeAttribute("hidden");

//   grandgrand.parentNode
//     .querySelector(
//       `[role="figure"][data-figure="${target.getAttribute("data-figure-cta")}"]`
//     )
//     .removeAttribute("hidden");
// }

function changeTabs(e) {
  const target = e.target;
  const parent = target.parentNode;
  const grandparent = parent.parentNode;
  const grandgrand = grandparent.parentNode.parentNode;

  // Remove all current selected tabs
  parent
    .querySelectorAll('[aria-selected="true"]')
    .forEach((t) => t.setAttribute("aria-selected", false));

  // Set this tab as selected
  target.setAttribute("aria-selected", true);

  // Hide all tab panels
  grandparent
    .querySelectorAll('[role="tabpanel"]')
    .forEach((p) => p.setAttribute("hidden", true));
  grandgrand
    .querySelectorAll('[role="figure"]')
    .forEach((s) => s.setAttribute("hidden", true));

  // Show the selected panel with slide animation
  const selectedPanel = grandparent.parentNode.querySelector(
    `#${target.getAttribute("aria-controls")}`
  );
  selectedPanel.removeAttribute("hidden");
  selectedPanel.classList.add("fade-up");
  setTimeout(() => {
    selectedPanel.classList.remove("fade-up");
  }, 7000);

  // Show the selected figure with slide animation
  const selectedFigure = grandgrand.parentNode.querySelector(
    `[role="figure"][data-figure="${target.getAttribute("data-figure-cta")}"]`
  );
  selectedFigure.removeAttribute("hidden");
  selectedFigure.classList.add("fade-in");
  setTimeout(() => {
    selectedFigure.classList.remove("fade-in");
  }, 7000);
}
