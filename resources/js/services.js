const { default: axios } = require("axios");

const app = new Vue({
    el: '#app',
    data: {
        selected: 0,
        selected_rol: '',
        selected_apli: '',
        selectedAplication: '',
        selectedRole: '',
        selectedFuncAplication: '',
        selectedFunc: '',
        funcId: '',
        txt_user: '',
        applications: [],
        functions: [],
        aplication: {
            id: '', name_aplication: '', desc_aplication: '', url_aplication: ''
        },
        rol: {
            id: '', nombre_rol: '', desc_rol: '', tipo_rol: ''
        },
        funApl : {
            id: '', name_funcion: '', desc_funcion: '', url_func: '', order: ''
        },
        s_users: [],
        roles_usuario: [],
        roles_funcion: [],
        isHiddenUsersBox: true,
        isHiddenBlockRol: true,
        isHiddenApppBox: true,
        usua_id: ''
    },
    methods: {
        loadApplications(){
            axios.post('getApplications', { rol_id: this.selected_rol }).then((reponse)=>{
                this.applications = reponse.data;
            });
        },
        redirect_page(){
            axios.post('generateToken', { apli_id: this.selected_apli, rol_id: this.selected_rol }).then((reponse)=>{
                if (isValidURL(reponse.data.route.apli_url)){
                    var route = "http://172.26.0.113/grados/create_token.php?token="+reponse.data.accessToken
                    route += "&rol="+reponse.data.rol_id
                    route += "&user="+reponse.data.user_id
                    route += "&usuario="+reponse.data.usua_nombre
                    route += "&peye="+reponse.data.peye_id
                    route += "&nick="+reponse.data.usua_nick
                    route += "&unid=1"
                    route += "&route="+reponse.data.route.apli_url
                } else {
                    route = reponse.data.route.apli_url
                }
                window.location.href = route
            });
        },
        clearElement(idElement){ 
            $('#'+idElement).val('');
            if ( idElement == "exAplicacion"){
                this.selectedAplication = null
                this.aplication.id = null
                this.aplication.name_aplication = this.aplication.desc_aplication = this.aplication.url_aplication = null
            }
            if ( idElement == "exampleRole"){
                this.selectedRole = null
                this.rol.nombre_rol = this.rol.desc_rol = this.rol.tipo_rol = null
                this.rol.id = null
            }
        },
        changeAplication(){
            var idValue = $("#datalistOptions option[value='" + this.selectedAplication + "']").attr("data-value");
            axios.post('getApplicationId', { selected_apli: idValue }).then((reponse)=>{
                this.aplication.name_aplication = reponse.data.apli_nombre
                this.aplication.desc_aplication = reponse.data.apli_descripcion
                this.aplication.url_aplication = reponse.data.apli_url
                this.aplication.id = reponse.data.apli_id
            });
        },
        changeRole(){
            var idValue = $("#datalistRol option[value='" + this.selectedRole + "']").attr("data-value");
            axios.post('getRoleId', { selected_role: idValue }).then((reponse)=>{
                this.rol.nombre_rol = reponse.data.rol_nombre
                this.rol.desc_rol = reponse.data.rol_descripcion
                this.rol.tipo_rol = reponse.data.rol_tipo
                this.rol.id = reponse.data.rol_id
                reponse.data
            });
        },
        changeFuncAplication(){
            var idValue = $("#datalistAplications option[value='" + this.selectedFuncAplication + "']").attr("data-value");
            this.aplication.id = idValue
            axios.post('getFuncAplication', { selected_aplication: idValue }).then((reponse)=>{
                var arr_fun_aplis = ""
                $.each(reponse.data, function(key, value) {
                    arr_fun_aplis += "<option data-value='"+value.func_id+"' value='"+value.func_orden+" - "+value.func_nombre+"'></option>"
                });
                $("#datalistFuncionalidad").html(arr_fun_aplis)
            });
        },
        changeFunc(){
            var idValue = $("#datalistFuncionalidad option[value='" + this.selectedFunc + "']").attr("data-value");
            axios.post('getFuncId', { selected_func: idValue }).then((reponse)=>{
                this.funApl.name_funcion = reponse.data.func_nombre
                this.funApl.desc_funcion = reponse.data.func_descripcion
                this.funApl.url_func = reponse.data.func_urlrecurso
                this.funApl.id = reponse.data.func_id
                this.funApl.order = reponse.data.func_orden
                
                reponse.data
            });
        },
        deleteAplication(){
            axios.post('deleteAplication', { id: this.aplication.id }).then((reponse)=>{
                    window.location.reload();
            });
        },
        saveAplication(){
            axios.post('saveAplication', { id: this.aplication.id, name_aplication: this.aplication.name_aplication,
                desc_aplication: this.aplication.desc_aplication, url_aplication: this.aplication.url_aplication }).then((reponse)=>{
                    window.location.reload();
            });
        },
        deleteRol(){
            axios.post('deleteRol', { id: this.rol.id }).then((reponse)=>{
                window.location.reload();
            });
        },
        saveRol(){
            axios.post('saveRol', { id: this.rol.id, rol_nombre: this.rol.nombre_rol,
                rol_descripcion: this.rol.desc_rol, rol_tipo: this.rol.tipo_rol }).then((reponse)=>{
                window.location.reload();
            });
        },
        //FUNCIONALIDAD
        deleteFunction(){
            axios.post('deleteFunction', { id: this.funApl.id }).then((reponse)=>{
                    window.location.reload();
            });
        },
        saveFunction(){
            axios.post('saveFunction', { id: this.funApl.id, name_function: this.funApl.name_funcion, apli_id: this.aplication.id ,
                desc_funcion: this.funApl.desc_funcion, url_func: this.funApl.url_func, order: this.funApl.order }).then((reponse)=>{
                    window.location.reload();
            });
        },
        searchUser(){
            axios.post('searchuser', { txt_user: this.txt_user }).then((reponse)=>{
                var arr_users = []
                $.each(reponse.data, function(key, value) {
                    arr_users.push({
                        usua_nombre: value.usua_nombre,
                        id: value.usua_id,
                        usua_usuario: value.usua_usuario,
                        usua_documento: value.usua_documento,
                    });
                });
                this.s_users = arr_users
                this.isHiddenUsersBox = false
            });
        },
        showRolesUser(usua_id, e){
            var clickedElement = e.target;
            $( "#list_users a" ).removeClass( "active" );
            this.usua_id = usua_id
            axios.post('getRolesUser', { usua_id: usua_id }).then((reponse)=>{
                var arr_roles = []
                $.each(reponse.data, function(key, value) {
                    arr_roles.push({
                        id: value.usro_id,
                        rol_nombre: value.rol_nombre,
                    });
                });
                this.roles_usuario = arr_roles;
                this.isHiddenBlockRol = false
            });
            $(clickedElement).closest("a").addClass("active");
        },
        deleteRoleUser(usua_rol_id){
            axios.post('deleteRoleUser', { usua_rol_id: usua_rol_id, usua_id: this.usua_id }).then((reponse)=>{
                var arr_roles = []
                $.each(reponse.data, function(key, value) {
                    arr_roles.push({
                        id: value.usro_id,
                        rol_nombre: value.rol_nombre,
                    });
                });
                this.roles_usuario = arr_roles;
                this.isHiddenBlockRol = false
            });
        },
        addRoleUser(){
            var idValue = $("#datalistRol option[value='" + this.selectedRole + "']").attr("data-value");
            axios.post('addRoleUser', { rol_id: idValue, usua_id: this.usua_id }).then((reponse)=>{
                var arr_roles = []
                $.each(reponse.data, function(key, value) {
                    arr_roles.push({
                        id: value.usro_id,
                        rol_nombre: value.rol_nombre,
                    });
                });
                this.roles_usuario = arr_roles;
                this.isHiddenBlockRol = false
            });
        },
        searchAplicationsRole(){
            var idValue = $("#datalistRolApp option[value='" + this.selectedRole + "']").attr("data-value");
            this.rol.id = idValue
            axios.post('searchAplicationsRole', { selected_role: idValue }).then((reponse)=>{
                var arr_apli = []
                $.each(reponse.data, function(key, value) {
                    arr_apli.push({
                        id: value.rpap_id,
                        apli_nombre: value.apli_nombre,
                    });
                });
                this.applications = arr_apli;
                this.isHiddenApppBox = false;
            });
        },
        addAppRole(){
            var idValue = $("#datalistRol option[value='" + this.selectedAplication + "']").attr("data-value");
            axios.post('saveRoleAplication', { apli_id: idValue, rol_id: this.rol.id }).then((reponse)=>{
                var arr_apli = []
                $.each(reponse.data, function(key, value) {
                    arr_apli.push({
                        id: value.rpap_id,
                        apli_nombre: value.apli_nombre,
                    });
                });
                this.applications = arr_apli;
                this.isHiddenApppBox = false;
            });
        },
        deleteAppRole(rpap_id){
            axios.post('deleteAppRole', { rpap_id: rpap_id, rol_id: this.rol.id }).then((reponse)=>{
                var arr_apli = []
                $.each(reponse.data, function(key, value) {
                    arr_apli.push({
                        id: value.rpap_id,
                        apli_nombre: value.apli_nombre,
                    });
                });
                this.applications = arr_apli;
                this.isHiddenApppBox = false;
            });
        },
        searchFuncApplicationRol(){
            var idValue = $("#datalistFuncionalidad option[value='" + this.selectedFunc + "']").attr("data-value");
            this.funcId = idValue
            axios.post('getFuncAplicationRol', { func_id: idValue }).then((reponse)=>{
                var arr_roles = []
                $.each(reponse.data, function(key, value) {
                    arr_roles.push({
                        rpaf_id: value.rpaf_id,
                        rpap_id: value.rpap_id,
                        rol_nombre: value.rol_nombre,
                    });
                });
                this.roles_funcion = arr_roles;
                this.isHiddenBlockRol = false
            });
        },
        addRoleFunction(){
            var idValue = $("#datalistRol option[value='" + this.selectedRole + "']").attr("data-value");
            axios.post('addRoleFunction', { rol_id: idValue, func_id: this.funcId, apli_id: this.aplication.id }).then((reponse)=>{
                var arr_roles = []
                $.each(reponse.data, function(key, value) {
                    arr_roles.push({
                        rpaf_id: value.rpaf_id,
                        rpap_id: value.rpap_id,
                        rol_nombre: value.rol_nombre,
                    });
                });
                this.roles_funcion = arr_roles;
                this.isHiddenBlockRol = false
            });
        },
        deleteFuncRol(rpaf_id, rpap_id){
            axios.post('deleteRoleFunc', { rpaf_id: rpaf_id, rpap_id: rpap_id, func_id: this.funcId }).then((reponse)=>{
                var arr_roles = []
                $.each(reponse.data, function(key, value) {
                    arr_roles.push({
                        rpaf_id: value.rpaf_id,
                        rpap_id: value.rpap_id,
                        rol_nombre: value.rol_nombre,
                    });
                });
                this.roles_funcion = arr_roles;
                this.isHiddenBlockRol = false
            });
        },
    }
});

function isValidURL(string) {
    var res = string.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
    return (res !== null)
};