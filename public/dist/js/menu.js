const menuForm = document.getElementById("menu-form");
const createBtn = document.getElementById("btn-menu-create");
const cancelEditBtn = document.getElementById("btn-edit-cancel");

function generateMenuRow(menu) {
    console.log("New menu: ", menu);
    let tableRow = document.createElement('tr');
    tableRow.setAttribute('class', 'intro-x');
    tableRow.dataset.id = menu.id;
    let nameCell = document.createElement('td');
    nameCell.innerHTML = `<div class="font-medium whitespace-nowrap">
        ${menu.Name}
    </div>`;

    tableRow.appendChild(nameCell);
    let countCell = document.createElement('td');
    countCell.classList.add('text-center');
    countCell.innerText = '36';
    tableRow.appendChild(countCell);

    let createdAtCell = document.createElement('td');
    createdAtCell.setAttribute('class', 'w-40');
    createdAtCell.innerHTML = `<div class="flex items-center justify-center text-theme-6"> 2022-01-01 </div>`;
    tableRow.appendChild(createdAtCell);


    let actionCell = document.createElement('td');
    actionCell.setAttribute('style' ,'table-report__action w-56');

    actionCell.innerHTML = `<div class="flex justify-center items-center">
                                        <a class="flex items-center mr-3" 
                                        data-id="${menu.MenuID}"
                                        href="#" onclick="editMenu(this)"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                        <a class="flex items-center text-theme-6" 
                                        href="#" data-id="${menu.MenuID}"
                                        onclick="confirmDelete(this)"
                                        data-toggle="modal" data-target="#delete-confirmation-modal"> 
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                    </div>`;

    tableRow.appendChild(actionCell);

    return tableRow;
}

cancelEditBtn.addEventListener('click', function(e) {
    e.preventDefault();

    cash('#menu-name').val('');
    cash('#menu-id').val('');

    cancelEditBtn.classList.add('invisible');
});

menuForm.addEventListener("submit", function(e) {
    e.preventDefault();
    const tableBody = document.getElementById("menu-table-body");
    const menuId = cash("#menu-id").val();
    const menuName = cash("#menu-name").val();

    const payload = {name: menuName};

    if(menuId !== '') payload.MenuId = menuId;

    axios.post('menu', payload).then(function(res) {
        const result = res.data;
        const menuRow = generateMenuRow(result.menu);
        if(menuId && menuId !== '') {
            let oldMenu = tableBody.querySelector(`tr[data-id="${menuId}"]`);
            tableBody.replaceChild(menuRow, oldMenu);

            cash('#menu-name').val('');
            cash('#menu-id').val('');
            createBtn.innerText = "Add";
            cancelEditBtn.classList.add('invisible');
        } else {
            tableBody.appendChild(menuRow);
        }
        
        feather.replace();
    });
});

function editMenu(link)
{
    const id = link.dataset.id;

    axios.get(`menu/${id}`).then(function(res) {
        const result = res.data;
        const menu = result.menu;
        cash('#menu-name').val(menu.Name);
        cash('#menu-id').val(menu.MenuID);

        createBtn.innerText = "Update";
        cancelEditBtn.classList.remove('invisible');
    });
    
}

function confirmDelete(link)
{
    const id = link.dataset.id;
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
        axios.get(`menu/delete/${id}`).then(function(res) {
            swal("Deleted! Menu has been deleted!", {
                icon: "success",
            });
            link.closest('tr').remove();
        });
    } else {
        swal("Your imaginary file is safe!");
    }
    });
}