const menuForm = document.getElementById("menu-form");
const createBtn = document.getElementById("btn-menu-create");
const cancelEditBtn = document.getElementById("btn-edit-cancel");

function generateMenuRow(menu) {
    let tableRow = document.createElement('tr');
    tableRow.setAttribute('class', 'intro-x');
    tableRow.dataset.id = menu.MenuSubID;
    let titleCell = document.createElement('td');
    titleCell.innerHTML = `<div class="font-medium whitespace-nowrap">
        ${menu.Title}
    </div>`;

    tableRow.appendChild(titleCell);
    let nameCell = document.createElement('td');
    nameCell.classList.add('text-center');
    nameCell.innerText = menu.Name;
    tableRow.appendChild(nameCell);

    let parentMenuCell = document.createElement('td');
    parentMenuCell.classList.add('text-center');
    parentMenuCell.innerText = menu.menu.Title;
    tableRow.appendChild(parentMenuCell);

    let routeNameCell = document.createElement('td');
    routeNameCell.classList.add('text-center');
    routeNameCell.innerText = menu.RouteName;
    tableRow.appendChild(routeNameCell);


    let actionCell = document.createElement('td');
    actionCell.setAttribute('style' ,'table-report__action w-56');

    actionCell.innerHTML = `<div class="flex justify-center items-center">
                                        <a class="flex items-center mr-3"
                                        data-id="${menu.MenuSubID}"
                                        href="#" onclick="editSubMenu(this)"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                        <a class="flex items-center text-theme-6"
                                        href="#" data-id="${menu.MenuSubID}"
                                        onclick="confirmDelete(this)"
                                        data-toggle="modal" data-target="#delete-confirmation-modal">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                    </div>`;

    tableRow.appendChild(actionCell);

    return tableRow;
}

cancelEditBtn.addEventListener('click', function(e) {
    e.preventDefault();

    menuForm.reset();
    cash("#sub-menu-id").val('');


    cancelEditBtn.classList.add('invisible');
});

menuForm.addEventListener("submit", function(e) {
    e.preventDefault();
    const tableBody = document.getElementById("menu-table-body");
    const subMenuId = cash("#sub-menu-id").val();
    const menuName = cash("#menu-name").val();
    const menuTitle = cash("#menu-title").val();
    const routeName = cash("#route-name").val();
    const parentMenu = cash("#parent-menu").val();
    const permissionId = cash("#menu-permission").val();

    const payload = {
        Name: menuName,
        Title: menuTitle,
        RouteName: routeName,
        MenuID: parentMenu,
        PermissionID: permissionId
    };

    if(subMenuId !== '') payload.MenuSubID = subMenuId;

    axios.post('sub-menu', payload).then(function(res) {
        const result = res.data;
        const menuRow = generateMenuRow(result.subMenu);
        if(subMenuId && subMenuId !== '') {
            let oldMenu = tableBody.querySelector(`tr[data-id="${subMenuId}"]`);
            tableBody.replaceChild(menuRow, oldMenu);

            createBtn.innerText = "Add";
            cancelEditBtn.classList.add('invisible');
        } else {
            tableBody.appendChild(menuRow);
        }

        menuForm.reset();
        cash("#sub-menu-id").val('');

        feather.replace();
    });
});

function editSubMenu(link)
{
    const id = link.dataset.id;

    axios.get(`sub-menu/${id}`).then(function(res) {
        const result = res.data;
        const menu = result.subMenu;
        cash("#sub-menu-id").val(id);
        cash('#menu-id').val(menu.MenuSubID);
        cash('#menu-name').val(menu.Name);
        cash('#menu-title').val(menu.Title);
        cash('#route-name').val(menu.RouteName);
        cash('#parent-menu').val(menu.MenuID);
        cash("#menu-permission").val(menu.PermissionID);

        createBtn.innerText = "Update";
        cancelEditBtn.classList.remove('invisible');
    });

}

function confirmDelete(link)
{
    const id = link.dataset.id;
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this sub menu!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
        axios.get(`sub-menu/delete/${id}`).then(function(res) {
            swal("Deleted! Sub menu has been deleted!", {
                icon: "success",
            });
            link.closest('tr').remove();
        });
    } else {
        swal("Sub menu is safe!");
    }
    });
}
