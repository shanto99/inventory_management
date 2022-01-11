const permissionForm = document.getElementById("permission-form");
const createBtn = document.getElementById("btn-permission-create");
const cancelEditBtn = document.getElementById("btn-edit-cancel");

function generatePermissionRow(permission) {
    console.log("New permission: ", permission);
    let tableRow = document.createElement('tr');
    tableRow.setAttribute('class', 'intro-x');
    tableRow.dataset.id = permission.id;
    let nameCell = document.createElement('td');
    nameCell.innerHTML = `<div class="font-medium whitespace-nowrap">
        ${permission.name}
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
                                        data-id="${permission.id}"
                                        href="#" onclick="editPermission(this)"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                        <a class="flex items-center text-theme-6" 
                                        href="#" data-id="${permission.id}"
                                        onclick="confirmDelete(this)"
                                        data-toggle="modal" data-target="#delete-confirmation-modal"> 
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                    </div>`;

    tableRow.appendChild(actionCell);

    return tableRow;
}

cancelEditBtn.addEventListener('click', function(e) {
    e.preventDefault();

    cash('#permission-name').val('');
    cash('#permission-id').val('');

    cancelEditBtn.classList.add('invisible');
});

permissionForm.addEventListener("submit", function(e) {
    e.preventDefault();
    const tableBody = document.getElementById("permission-table-body");
    const permissionId = cash("#permission-id").val();
    const permissionName = cash("#permission-name").val();

    const payload = {name: permissionName};

    if(permissionId !== '') payload.PermissionId = permissionId;

    axios.post('permission', payload).then(function(res) {
        const result = res.data;
        const permissionRow = generatePermissionRow(result.permission);
        if(permissionId && permissionId !== '') {
            let oldPermission = tableBody.querySelector(`tr[data-id="${permissionId}"]`);
            tableBody.replaceChild(permissionRow, oldPermission);

            cash('#permission-name').val('');
            cash('#permission-id').val('');
            createBtn.innerText = "Add";
            cancelEditBtn.classList.add('invisible');
        } else {
            tableBody.appendChild(permissionRow);
        }
        
        feather.replace();
    });
});

function editPermission(link)
{
    const id = link.dataset.id;
    axios.get(`permission/${id}`).then(function(res) {
        const result = res.data;
        const permission = result.permission;
        cash('#permission-name').val(permission.name);
        cash('#permission-id').val(permission.id);

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
        axios.get(`permission/delete/${id}`).then(function(res) {
            swal("Deleted! Permission has been deleted!", {
                icon: "success",
            });
            link.closest('tr').remove();
        });
    } else {
        swal("Your imaginary file is safe!");
    }
    });
}