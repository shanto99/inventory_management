function assignPermissionToRole(element) {
    const roleId = element.dataset.roleId;
    const permissionId = element.dataset.permissionId;

    axios.post('assign-permission-role', {
        roleId: roleId,
        permissionId: permissionId,
        isRemove: !element.checked
    }).then(function(res) {
        console.log(res);
    });

}