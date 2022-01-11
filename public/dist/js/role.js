const roleForm = document.getElementById("role-form");
const createBtn = document.getElementById("btn-role-create");
const cancelEditBtn = document.getElementById("btn-edit-cancel");

function generateRoleRow(role) {
    console.log("New role: ", role);
    let tableRow = document.createElement('tr');
    tableRow.setAttribute('class', 'intro-x');
    tableRow.dataset.id = role.id;
    let nameCell = document.createElement('td');
    nameCell.innerHTML = `<div class="font-medium whitespace-nowrap">
        ${role.name}
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
                                        data-id="${role.id}"
                                        href="#" onclick="editRole(this)"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                        <a class="flex items-center text-theme-6" 
                                        href="#" data-id="${role.id}"
                                        onclick="confirmDelete(this)"
                                        data-toggle="modal" data-target="#delete-confirmation-modal"> 
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                    </div>`;

    tableRow.appendChild(actionCell);

    return tableRow;
}

cancelEditBtn.addEventListener('click', function(e) {
    e.preventDefault();

    cash('#role-name').val('');
    cash('#role-id').val('');

    cancelEditBtn.classList.add('invisible');
});

roleForm.addEventListener("submit", function(e) {
    e.preventDefault();
    const tableBody = document.getElementById("role-table-body");
    const roleId = cash("#role-id").val();
    const roleName = cash("#role-name").val();

    const payload = {name: roleName};

    if(roleId !== '') payload.RoleId = roleId;

    axios.post('role', payload).then(function(res) {
        const result = res.data;
        const roleRow = generateRoleRow(result.role);
        if(roleId && roleId !== '') {
            let oldRole = tableBody.querySelector(`tr[data-id="${roleId}"]`);
            tableBody.replaceChild(roleRow, oldRole);

            cash('#role-name').val('');
            cash('#role-id').val('');
            createBtn.innerText = "Add";
            cancelEditBtn.classList.add('invisible');
        } else {
            tableBody.appendChild(roleRow);
        }
        
        feather.replace();
    });
});

function editRole(link)
{
    const id = link.dataset.id;
    axios.get(`role/${id}`).then(function(res) {
        const result = res.data;
        const role = result.role;
        cash('#role-name').val(role.name);
        cash('#role-id').val(role.id);

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
        axios.get(`role/delete/${id}`).then(function(res) {
            swal("Deleted! Role has been deleted!", {
                icon: "success",
            });
            link.closest('tr').remove();
        });
    } else {
        swal("Your imaginary file is safe!");
    }
    });
}