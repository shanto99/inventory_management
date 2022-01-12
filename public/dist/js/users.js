function confirmDelete(link)
{
    const id = link.dataset.id;
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this user!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
        axios.get(`users/delete/${id}`).then(function(res) {
            swal("Deleted! User has been deleted!", {
                icon: "success",
            });
            link.closest('tr').remove();
        }).catch(function(err) {
            swal("You don't have the permission", {
                icon: "error",
            });
        })
    } else {
        swal("User is safe!");
    }
    });
}