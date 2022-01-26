const warehouseForm = document.getElementById("warehouse-form");
const createBtn = document.getElementById("btn-warehouse-create");
const cancelEditBtn = document.getElementById("btn-warehouse-cancel");

cancelEditBtn.onclick = function(e) {
    e.currentTarget.classList.add("hidden");
    createBtn.innerText  ="Add";
    warehouseForm.reset();

}

function generateWarehouseRow(warehouse) {
    let tableRow = document.createElement('tr');
    tableRow.setAttribute('class', 'intro-x');
    tableRow.dataset.id = warehouse.WarehouseCode;

    let WarehouseCodeCell = document.createElement('td');
    WarehouseCodeCell.classList.add('text-center');
    WarehouseCodeCell.innerText = warehouse.WarehouseCode;

    tableRow.appendChild(WarehouseCodeCell);

    let WarehouseNameCell = document.createElement('td');
    WarehouseNameCell.classList.add('text-center');
    WarehouseNameCell.innerText = warehouse.WarehouseName;

    tableRow.appendChild(WarehouseNameCell);

    let AddressCell = document.createElement('td');
    AddressCell.classList.add('text-center');
    AddressCell.innerHTML = warehouse.Address;

    tableRow.appendChild(AddressCell);


    let actionCell = document.createElement('td');
    actionCell.setAttribute('style' ,'table-report__action w-56');

    actionCell.innerHTML = `<div class="flex justify-center items-center">
                                        <a class="flex items-center mr-3"
                                        data-id="${warehouse.WarehouseCode}"
                                        href="#" onclick="editWarehouse(this)"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit/Details </a>
                                        <a class="flex items-center text-theme-6"
                                        href="#" data-id="${warehouse.WarehouseCode}"
                                        onclick="confirmDelete(this)"
                                        data-toggle="modal" data-target="#delete-confirmation-modal">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                    </div>`;

    tableRow.appendChild(actionCell);

    return tableRow;
}

warehouseForm.addEventListener("submit", function(e) {
    e.preventDefault();
    const tableBody = document.getElementById("menu-table-body");
    const WarehouseCode = cash("#WarehouseCode").val();
    const WarehouseName = cash("#WarehouseName").val();
    const Address = cash("#Address").val();
    const FactoryAddress = cash("#FactoryAddress").val();
    const ContactPerson = cash("#ContactPerson").val();
    const Phone = cash("#Phone").val();
    const Email = cash("#Email").val();
    const VATRegNo = cash("#VATRegNo").val();
    const BIN = cash("#BIN").val();
    const TIN = cash("#TIN").val();
    const Country = cash("#Country").val();
    const IUser = cash("#IUser").val();
    const IDate = cash("#IDate").val();
    const EUser = cash("#EUser").val();
    const EDate = cash("#EDate").val();

    const payload = {WarehouseCode,WarehouseName,Address,FactoryAddress,ContactPerson,Phone,Email,VATRegNo,BIN,TIN,Country,IUser,IDate,EUser,EDate};

    axios.post('create-warehouse', payload).then(function(res) {
        const result = res.data;
        const warehouseRow = generateWarehouseRow(result.warehouse);

        if(result.isUpdate) {
            let oldWarehouse = tableBody.querySelector(`tr[data-id="${WarehouseCode}"]`);
            tableBody.replaceChild(warehouseRow, oldWarehouse);
        } else {
            tableBody.appendChild(warehouseRow);
        }

        warehouseForm.reset();
        createBtn.innerText = "Add";
        cancelEditBtn.classList.add("hidden");

        feather.replace();
    });
});

function editWarehouse(link)
{
    const id = link.dataset.id;
    cancelEditBtn.classList.remove("hidden");
    createBtn.innerText = "Edit";

    axios.get(`warehouse/${id}`).then(function(res) {
        const result = res.data;
        const warehouse = result.warehouse;
        cash('#WarehouseCode').val(warehouse.WarehouseCode);
        cash('#WarehouseName').val(warehouse.WarehouseName);
        cash('#Address').val(warehouse.Address);
        cash('#FactoryAddress').val(warehouse.FactoryAddress);
        cash('#ContactPerson').val(warehouse.ContactPerson);
        cash("#Phone").val(warehouse.Phone);

        cash('#Email').val(warehouse.Email);
        cash('#VATRegNo').val(warehouse.VATRegNo);
        cash('#BIN').val(warehouse.BIN);
        cash('#TIN').val(warehouse.TIN);
        cash('#Country').val(warehouse.Country);
        cash("#IUser").val(warehouse.IUser);
        cash("#IDate").val(warehouse.IDate);
        cash("#EDate").val(warehouse.EDate);
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
        axios.get(`warehouse/delete/${id}`).then(function(res) {
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
