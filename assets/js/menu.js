  const menuItemsHasChildren = document.querySelectorAll(
    "li.menu-item-has-children"
  );

  menuItemsHasChildren.forEach((menuItem) => {
    menuItem.addEventListener("click", (e) => {
      e.stopPropagation();

      const subMenu = menuItem.querySelector("ul");
      if (menuItem.classList.contains("active-menu")) {
        menuItem.classList.remove("active-menu");
        subMenu.style.height = 0;
      } else {
        menuItem.classList.add("active-menu");
        subMenu.style.height = subMenu.scrollHeight + "px";
      }
    });
  });
