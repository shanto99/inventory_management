const companyForm = document.getElementById("company-form");
const createBtn = document.getElementById("btn-company-create");
const cancelEditBtn = document.getElementById("btn-company-cancel");

cancelEditBtn.onclick = function(e) {
    e.currentTarget.classList.add("hidden");
    createBtn.innerText  ="Add";
    companyForm.reset();

}

function generateCompanyRow(company) {
    let tableRow = document.createElement('tr');
    tableRow.setAttribute('class', 'intro-x');
    tableRow.dataset.id = company.CompanyCode;

    let CompanyCodeCell = document.createElement('td');
    CompanyCodeCell.classList.add('text-center');
    CompanyCodeCell.innerText = company.CompanyCode;

    tableRow.appendChild(CompanyCodeCell);

    let CompanyNameCell = document.createElement('td');
    CompanyNameCell.classList.add('text-center');
    CompanyNameCell.innerText = company.CompanyName;

    tableRow.appendChild(CompanyNameCell);

    let AddressCell = document.createElement('td');
    AddressCell.classList.add('text-center');
    AddressCell.innerHTML = company.Address;

    tableRow.appendChild(AddressCell);


    let actionCell = document.createElement('td');
    actionCell.setAttribute('style' ,'table-report__action w-56');

    actionCell.innerHTML = `<div class="flex justify-center items-center">
                                        <a class="flex items-center mr-3"
                                        data-id="${company.CompanyCode}"
                                        href="#" onclick="editCompany(this)"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit/Details </a>
                                        <a class="flex items-center text-theme-6"
                                        href="#" data-id="${company.CompanyCode}"
                                        onclick="confirmDelete(this)"
                                        data-toggle="modal" data-target="#delete-confirmation-modal">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                    </div>`;

    tableRow.appendChild(actionCell);

    return tableRow;
}

companyForm.addEventListener("submit", function(e) {
    e.preventDefault();
    const tableBody = document.getElementById("menu-table-body");
    const CompanyCode = cash("#CompanyCode").val();
    const CompanyName = cash("#CompanyName").val();
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

    const payload = {CompanyCode,CompanyName,Address,FactoryAddress,ContactPerson,Phone,Email,VATRegNo,BIN,TIN,Country,IUser,IDate,EUser,EDate};

    axios.post('create-company', payload).then(function(res) {
        const result = res.data;
        const companyRow = generateCompanyRow(result.company);

        if(result.isUpdate) {
            let oldCompany = tableBody.querySelector(`tr[data-id="${CompanyCode}"]`);
            tableBody.replaceChild(companyRow, oldCompany);
        } else {
            tableBody.appendChild(companyRow);
        }

        companyForm.reset();
        createBtn.innerText = "Add";
        cancelEditBtn.classList.add("hidden");

        feather.replace();
    });
});

function editCompany(link)
{
    const id = link.dataset.id;
    cancelEditBtn.classList.remove("hidden");
    createBtn.innerText = "Edit";

    axios.get(`company/${id}`).then(function(res) {
        const result = res.data;
        const company = result.company;
        cash('#CompanyCode').val(company.CompanyCode);
        cash('#CompanyName').val(company.CompanyName);
        cash('#Address').val(company.Address);
        cash('#FactoryAddress').val(company.FactoryAddress);
        cash('#ContactPerson').val(company.ContactPerson);
        cash("#Phone").val(company.Phone);

        cash('#Email').val(company.Email);
        cash('#VATRegNo').val(company.VATRegNo);
        cash('#BIN').val(company.BIN);
        cash('#TIN').val(company.TIN);
        cash('#Country').val(company.Country);
        cash("#IUser").val(company.IUser);
        cash("#IDate").val(company.IDate);
        cash("#EDate").val(company.EDate);
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
        axios.get(`company/delete/${id}`).then(function(res) {
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
