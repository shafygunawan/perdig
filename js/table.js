const searchManipulations = () => {
  const searchForm = document.querySelector(".search-form");
  const searchInput = searchForm.querySelector(".form-control");
  const searchBtn = searchForm.querySelector(".btn");
  const tbody = document.querySelector("tbody");

  const searchDatas = async (keyword) => {
    try {
      const response = await fetch(
        `${BASE_URL}/api${ENDPOINT}?keyword=${keyword}`
      );
      const responseJson = await response.json();

      return Promise.resolve(responseJson);
    } catch (message) {
      return Promise.reject(message);
    }
  };

  const renderDatas = (datas) => {
    tbody.innerHTML = "";
    datas.results.forEach((data) => {
      const trow = document.createElement("tr");

      if (ENDPOINT === "/books/search.php") {
        trow.innerHTML = `
          <td>
            <input type="checkbox" class="check-item" name="book_ids[]" value="${data.id}">
          </td>
          <td>${data.title}</td>
          <td>${data.author}</td>
          <td>${data.release_year}</td>
          <td>
            <a href="${BASE_URL}/books/edit.php?id=${data.id}" class="btn btn-link btn-sm py-0 edit-btn edit-btn-hide">
              <i class="fas fa-edit"></i>
            </a>
          </td>
          `;
      } else if (ENDPOINT === "/employees/search.php") {
        trow.innerHTML = `
          <td>
            <input type="checkbox" class="check-item" name="user_ids[]" value="${
              data.id
            }">
          </td>
          <td>${data.first_name + " " + data.last_name}</td>
          <td>${data.email}</td>
          <td>${data.level === "employee" ? "Employee" : "Admin"}</td>
          <td>
            <a href="${BASE_URL}/employees/edit.php?id=${
          data.id
        }" class="btn btn-link btn-sm py-0 edit-btn edit-btn-hide">
              <i class="fas fa-edit"></i>
            </a>
          </td>
          `;
      }

      tbody.appendChild(trow);
    });

    editManipulations();
    deleteItemsManipulations();
  };

  searchForm.addEventListener("keypress", async (event) => {
    if (event.key === "Enter") {
      event.preventDefault();
      searchBtn.click();
      event.target.blur();
    }
  });

  searchInput.addEventListener("input", async () => {
    try {
      const datas = await searchDatas(searchInput.value);
      renderDatas(datas);
    } catch (message) {
      console.log(message);
    }
  });

  searchBtn.addEventListener("click", async () => {
    try {
      const datas = await searchDatas(searchInput.value);
      renderDatas(datas);
    } catch (message) {
      console.log(message);
    }
  });
};

const editManipulations = () => {
  const trows = document.querySelectorAll("tbody tr");

  trows.forEach((trow) => {
    trow.addEventListener("mouseenter", (event) => {
      const editBtn = event.target.querySelector(".edit-btn");
      editBtn.classList.remove("edit-btn-hide");
    });
    trow.addEventListener("mouseleave", (event) => {
      const editBtn = event.target.querySelector(".edit-btn");
      editBtn.classList.add("edit-btn-hide");
    });
  });
};

const deleteManipulations = () => {
  const deleteBtn = document.querySelector(".delete-btn");
  const multipleDeleteForm = document.querySelector(".multiple-delete-form");

  deleteBtn.addEventListener("click", () => {
    multipleDeleteForm.submit();
  });

  deleteItemsManipulations();
};

const deleteItemsManipulations = () => {
  const deleteModalToggler = document.querySelector(".delete-modal-toggler");
  const selectAll = document.querySelector("#select-all");
  const checkItems = document.querySelectorAll(".check-item");
  const container = document.querySelector(".select-all-container");
  const label = selectAll.nextElementSibling;

  deleteModalToggler.classList.add("disabled");
  selectAll.checked = false;

  if (!checkItems.length) {
    selectAll.disabled = true;
    selectAll.classList.add("disabled");
    label.classList.add("text-white-50");
    container.classList.add("disabled");
  } else {
    selectAll.disabled = false;
    selectAll.classList.remove("disabled");
    label.classList.remove("text-white-50");
    container.classList.remove("disabled");
  }

  selectAll.addEventListener("change", () => {
    checkItems.forEach((checkItem) => {
      if (selectAll.checked) {
        checkItem.checked = true;
        deleteModalToggler.classList.remove("disabled");
        return;
      }
      checkItem.checked = false;
      deleteModalToggler.classList.add("disabled");
    });
  });

  checkItems.forEach((checkItem) => {
    checkItem.addEventListener("change", () => {
      let isCheckedAll = true;
      let hasCheckedItem = false;

      checkItems.forEach((checkItem) => {
        if (!checkItem.checked) {
          isCheckedAll = false;
          return;
        }
        hasCheckedItem = true;
      });

      if (isCheckedAll) {
        selectAll.checked = true;
      } else {
        selectAll.checked = false;
      }

      if (hasCheckedItem) {
        deleteModalToggler.classList.remove("disabled");
      } else {
        deleteModalToggler.classList.add("disabled");
      }
    });
  });
};

window.addEventListener("load", () => {
  searchManipulations();
  editManipulations();
  deleteManipulations();
});
