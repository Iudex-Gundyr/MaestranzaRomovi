document.querySelectorAll('.navbar li').forEach(item => {
    item.addEventListener('click', event => {
        const subMenu = item.querySelector('.sub-menu');
        const arrowIcon = item.querySelector('.arrow-icon');
        if (subMenu) {
            if (subMenu.style.display === 'block') {
                subMenu.style.display = 'none';
                arrowIcon.classList.remove('fa-arrow-up');
                arrowIcon.classList.add('fa-arrow-down');
            } else {
                subMenu.style.display = 'block';
                arrowIcon.classList.remove('fa-arrow-down');
                arrowIcon.classList.add('fa-arrow-up');
            }
        }
    });
});



function confirmarEliminarUsuario(userId) {
    if (confirm("¿Estás seguro de que quieres eliminar este usuario?")) {
        window.location.href = "/eliminarUsuario/" + userId;
    }
}

function confirmarEliminarMedida(medidaId) {
    if (confirm("¿Estás seguro de que quieres eliminar esta medida?")) {
        window.location.href = "/eliminarUnidadMedida/" + medidaId;
    }
}

function confirmarEliminarUbicacion(UbicacionId) {
    if (confirm("¿Estás seguro de que quieres eliminar esta Ubicacion?")) {
        window.location.href = "/eliminarUbicacion/" + UbicacionId;
    }
}

function confirmarEliminarAlmacenes(AlmacenId) {
    if (confirm("¿Estás seguro de que quieres eliminar este Almacen?")) {
        window.location.href = "/eliminarAlmacen/" + AlmacenId;
    }
}
function confirmarEliminarMaterial(MaterialId) {
    if (confirm("¿Estás seguro de que quieres eliminar este Material?")) {
        window.location.href = "/eliminarMaterial/" + MaterialId;
    }
}

function confirmarEliminarMaterial_Almacen(id,Mat_AlmId) {
    if (confirm("¿Estás seguro de que quieres eliminar este Material?")) {
        window.location.href = "/eliminarMaterialAlmacen/" + id +"/"+ Mat_AlmId;
    }
}
confirmarEliminarEntrada
function confirmarEliminarEntrada(id,entradaId) {
    if (confirm("¿Estás seguro de que quieres eliminar este Material?")) {
        window.location.href = "/eliminarEntrada/" + id +"/"+ entradaId;
    }
}

function confirmarEliminarSalida(id,salidaId) {
    if (confirm("¿Estás seguro de que quieres eliminar este Material?")) {
        window.location.href = "/eliminarSalida/" + id +"/"+ salidaId;
    }
}