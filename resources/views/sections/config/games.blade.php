@extends('template.base')

@section('content-title', 'Configuración')

@section('content-subtitle', 'Juegos')

@section('breadcrumb')
    <li>Configuración</li>
    <li class="active">Juegos</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12" id="messages"></div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div id="toolbar" class="btn-group">
                        <button data-toggle="modal" data-target="#modal-create" class="btn btn-success"><i
                                    class="fa fa-plus"></i> Nuevo Juego
                        </button>
                    </div>
                    <table
                            id="table"
                            data-toggle="table"
                            data-search="true"
                            data-ajax="ajaxRequest"
                            data-pagination="true"
                            data-striped="true"
                            data-show-refresh="true"
                            data-show-toggle="true"
                            data-show-columns="true"
                            data-show-export="true"
                            data-detail-formatter="detailFormatter"
                            data-minimum-count-columns="2"
                            data-show-pagination-switch="true"
                            data-id-field="id"
                            data-page-list="[5, 10, 20, 50, 100, 200]"
                            data-toolbar="#toolbar"
                           >
                        <thead>
                        <tr>
                            <th data-field="status" data-checkbox="true" data-tableexport-display="none"></th>
                            <th data-field="id" data-sortable="true">ID</th>
                            <th data-field="name" data-cell-style="cellStyle" data-sortable="true">Nombre</th>
                            <!--th data-field="companies.name" data-sortable="true">Compañia</th-->
                            <th data-field="description" data-sortable="true">Descripción</th>
                            <th data-field="created_at" data-cell-style="cellStyle" data-align="center" data-sortable="true" data-formatter="dateFormat" >Creado</th>
                            <th data-field="updated_at" data-cell-style="cellStyle" data-align="center" data-sortable="true" data-formatter="dateFormat" data-sorteable="true" >Modificado</th>
                            <th data-field="active" data-switchable="false" data-formatter="operateFormatterActive" data-show-columns="false" data-tableexport-display="none"></th>
                            <th data-field="controls" data-cell-style="cellStyle" data-switchable="false" data-formatter="operateFormatterControls" data-show-columns="false" data-tableexport-display="none"></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--modal create-->
    <div class="modal fade in" id="modal-create">
        <div class="modal-dialog modal-lg">
            <form method="post" id="form-create" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" onclick="dissmisModal('#form-create','#modal-create')" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Nuevo Juego </h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group col-md-12" id="group-error-cover-create">
                                    <label for="cover">Caratula del Juego</label>
                                    <div class="image-cover">
                                        <img id="image-cover" class="img-thumbnail" height="370px" width="100%" src="{{ Storage::url('covers/cover-default.png') }}">
                                    </div>
                                    <input type="file" name="cover" id="file"
                                           class="inputfile" accept="image/x-png,image/gif,image/jpeg"/>
                                    <label for="file">Seleccione Caratula del Juego</label>
                                    <span class="help-block" id="label-error-cover-create"></span>
                                    <div class="link-del" onclick="deleteAvatarCreate();"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="group-error-name-create" class="form-group">
                                    <label class="control-label " for="name">
                                        Nombre
                                    </label>
                                    <input class="form-control" type="text" id="name" name="name"
                                           placeholder="Ingrese un nombre.">
                                    <span id="label-error-name-create" class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group col-md-6" id="group-error-companies_id-create">
                                <label for="role_id">Compañia</label>
                                <select class="form-control"  id="company_id" name="companies_id">
                                    <option selected disabled value="">Seleccione</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}" >{{$company->name}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block" id="label-error-companies_id-create"></span>
                            </div>
                            <div class="form-group col-md-6" id="group-error-plataforms_id-create">
                                <label for="role_id">Plataforma</label>
                                <select class="form-control" id="plataform_id" name="plataforms_id">
                                    <option selected disabled value="">Seleccione</option>
                                    @foreach($plataforms as $plataform)
                                        <option value="{{$plataform->id}}" >{{$plataform->name}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block" id="label-error-plataforms_id-create"></span>
                            </div>
                            <div class="form-group col-md-6" id="group-error-game_types_id-create">
                                <label for="role_id">Tipo de Juego</label>
                                <select class="form-control" id="game_types_id" name="game_types_id">
                                    <option selected disabled value="">Seleccione</option>
                                    @foreach($game_types as $game_type)
                                        <option value="{{$game_type->id}}" >{{$game_type->name}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block" id="label-error-game_types_id-create"></span>
                            </div>
                            <div class="form-group col-md-6" id="group-error-categories_id-create">
                                <label for="role_id">Categoría</label>
                                <select class="form-control" id="categories_id" name="categories_id">
                                    <option selected disabled value="">Seleccione</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" >{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block" id="label-error-categories_id-create"></span>
                            </div>
                            <div class="form-group col-md-6" id="group-error-clasification-create">
                                <label class="control-label" for="clasification">
                                    Clasificación
                                </label>
                                <input class="form-control" type="text" id="clasification" name="clasification"
                                       placeholder="Ingrese clasificación" >
                                <span id="label-error-clasification-create" class="help-block"></span>
                            </div>
                            <div class="form-group col-md-6" id="group-error-stock-create">
                                <label class="control-label" for="stock">
                                    Stock
                                </label>
                                <input class="form-control" type="number" min="0" step="1" id="stock" name="stock"
                                       placeholder="Ingrese stock" >
                                <span id="label-error-stock-create" class="help-block"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6" id="group-error-price-create">
                                <label class="control-label" for="price">
                                    Precio de Venta
                                </label>
                                <input class="form-control" type="number" min="0" step="1" id="price" name="price"
                                       placeholder="Ingrese precio" >
                                <span id="label-error-price-create" class="help-block"></span>
                            </div>
                            <div class="col-md-6" id="group-error-web-create">
                                <div class="form-group">
                                    <label class="control-label" for="web">
                                        Link para descarga (Opcional)
                                    </label>
                                    <input class="form-control" type="text" id="web" name="web"
                                           placeholder="Ingrese link para descarga" >
                                </div>
                                <span id="label-error-web-create" class="help-block"></span>
                            </div>
                            <div class="form-group col-md-12" id="group-error-description-create">
                                <label class="control-label" for="description">
                                    Descripción
                                </label>
                                <textarea class="form-control" name="description" id="description" rows="5"
                                          placeholder="Ingrese una descripción"></textarea>
                                <span id="label-error-description-create" class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="dissmisModal('#form-create','#modal-create')" class="btn btn-danger pull-left">Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--modal edit-->
    <div class="modal fade in" id="modal-edit">
        <div class="modal-dialog modal-lg">
            <form method="post" id="form-edit">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id-edit" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" onclick="dissmisModal('#form-edit','#modal-edit')" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Editar Juego </h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group col-md-12" id="group-error-cover-edit">
                                    <label for="cover">Caratula del Juego</label>
                                    <div class="image-cover">
                                        <img id="image-cover-edit" class="img-thumbnail" height="370px" width="100%" src="{{ Storage::url('covers/cover-default.png') }}">
                                    </div>
                                    <input type="file" name="cover" id="file-edit"
                                           class="inputfile" accept="image/x-png,image/gif,image/jpeg"/>
                                    <label for="file-edit">Seleccione Caratula del Juego</label>
                                    <span class="help-block" id="label-error-cover-edit"></span>
                                    <div class="link-del" onclick="deleteAvatarEdit();"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="group-error-name-edit" class="form-group">
                                    <label class="control-label " for="name">
                                        Nombre
                                    </label>
                                    <input class="form-control" type="text" id="name" name="name"
                                           placeholder="Ingrese un nombre.">
                                    <span id="label-error-name-edit" class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group col-md-6" id="group-error-companies_id-edit">
                                <label for="role_id">Compañia</label>
                                <select class="form-control"  id="companies_id" name="companies_id">
                                    <option selected disabled value="">Seleccione</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}" >{{$company->name}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block" id="label-error-companies_id-edit"></span>
                            </div>
                            <div class="form-group col-md-6" id="group-error-plataforms_id-edit">
                                <label for="role_id">Plataforma</label>
                                <select class="form-control" id="plataforms_id" name="plataforms_id">
                                    <option selected disabled value="">Seleccione</option>
                                    @foreach($plataforms as $plataform)
                                        <option value="{{$plataform->id}}" >{{$plataform->name}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block" id="label-error-plataforms_id-edit"></span>
                            </div>
                            <div class="form-group col-md-6" id="group-error-game_types_id-edit">
                                <label for="role_id">Tipo de Juego</label>
                                <select class="form-control" id="game_types_id" name="game_types_id">
                                    <option selected disabled value="">Seleccione</option>
                                    @foreach($game_types as $game_type)
                                        <option value="{{$game_type->id}}" >{{$game_type->name}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block" id="label-error-game_types_id-edit"></span>
                            </div>
                            <div class="form-group col-md-6" id="group-error-categories_id-edit">
                                <label for="role_id">Categoría</label>
                                <select class="form-control" id="categories_id" name="categories_id">
                                    <option selected disabled value="">Seleccione</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" >{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block" id="label-error-categories_id-edit"></span>
                            </div>
                            <div class="form-group col-md-6" id="group-error-clasification-edit">
                                <label class="control-label" for="clasification">
                                    Clasificación
                                </label>
                                <input class="form-control" type="text" id="clasification" name="clasification"
                                       placeholder="Ingrese clasificación" >
                                <span id="label-error-clasification-edit" class="help-block"></span>
                            </div>
                            <div class="form-group col-md-6" id="group-error-stock-edit">
                                <label class="control-label" for="stock">
                                    Stock
                                </label>
                                <input class="form-control" type="number" min="0" step="1" id="stock" name="stock"
                                       placeholder="Ingrese stock" >
                                <span id="label-error-stock-edit" class="help-block"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6" id="group-error-price-edit">
                                <label class="control-label" for="price">
                                    Precio de Venta
                                </label>
                                <input class="form-control" type="number" min="0" step="1" id="price" name="price"
                                       placeholder="Ingrese precio" >
                                <span id="label-error-price-edit" class="help-block"></span>
                            </div>
                            <div class="col-md-6" id="group-error-web-edit">
                                <div class="form-group">
                                    <label class="control-label" for="web">
                                        Link para descarga (Opcional)
                                    </label>
                                    <input class="form-control" type="text" id="web" name="web"
                                           placeholder="Ingrese link para descarga" >
                                </div>
                                <span id="label-error-web-edit" class="help-block"></span>
                            </div>
                            <div class="form-group col-md-12" id="group-error-description-edit">
                                <label class="control-label" for="description">
                                    Descripción
                                </label>
                                <textarea class="form-control" name="description" id="description" rows="5"
                                          placeholder="Ingrese una descripción"></textarea>
                                <span id="label-error-description-edit" class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="dissmisModal('#form-edit','#modal-edit')" class="btn btn-danger pull-left">Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('styles')

    <link rel="stylesheet" href="/assets/bootstraptable/dragtable.css">
    <link rel="stylesheet" href="/assets/bootstraptable/bootstrap-table-reorder-rows.css">
    <link rel="stylesheet" href="/assets/bootstraptable/bootstrap-table-fixed-columns.css">
    <link rel="stylesheet" href="/assets/bootstraptable/bootstrap-table.min.css">

@endsection

@section('scripts')
    <script src="/assets/bootstraptable/bootstrap-table.min.js"></script>
    <script src="/assets/bootstraptable/bootstrap-table-es-ES.min.js"></script>
    <script src="/assets/bootstraptable/bootstrap-table-export.min.js"></script>
    <script src="/assets/bootstraptable/tableExport.min.js"></script>
    <script src="/assets/required/app.js"></script>

        <!--script>

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image-cover').attr('src', e.target.result);
                    $('#image-cover').attr('class', 'img-thumbnail');
                    $('.link-del').html('borrar');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURLEdit(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image-cover-edit').attr('src', e.target.result);
                    $('#image-cover-edit').height($('#image-cover-edit').width());
                    $('.link-del').html('borrar');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#file").change(function () {
            readURL(this);
        });

        $('#form-edit').find('#file-edit').change(function () {
            readURLEdit(this);
        });

        function deleteAvatarCreate() {
            $('#modal-create #image-cover').attr('src', '{{ Storage::url('covers/cover-default.png') }}');
            $('.link-del').html('');
            $("#modal-create #file").val('');
        }

        function deleteAvatarEdit() {
            $('#modal-edit #image-cover-edit').attr('src', '{{ Storage::url('covers/cover-default.png') }}');
            $('.link-del').html('');
            $("#modal-edit #file").val('');
        }
    </script>



    <script>

        var items = [];

        // cargar datos
        function ajaxRequest(params){

            $.ajax({
                type: "GET",
                contentType : "application/json",
                url: "{{ route('games.all') }}",
                success: function(data) {
                    params.success(data);
                    items = data;
                    $("#table").bootstrapTable({
                       exportHiddenColumns: ["active", "controls","status"],
                    });
                }
            });
        }

        // formato de la tabla -> carga de datos
        function detailFormatter(index, row) {

            var titles = [
                {id: 'id', name: 'Id'},
                {id: 'name', name: 'Nombre'},
                {id: 'web', name: 'Página Web'},
                {id: 'description', name: 'Descripción'},
                {id: 'created_at', name: 'Creado'},
                {id: 'updated_at', name: 'Modificado'},
                {id: 'active', name: 'Estado'}
            ];

            var html = [];

            $.each(row, function (key, value) {
                var title = titles.find(title => title.id === key);
                if (title) {

                    if(title.id === 'active'){
                        value = value == 1 ? "Activado" : "Desactivado";
                    }

                    value = value ? value : "-";

                    html.push('' +
                        '<div style=" width: 10%; float: left;">' +
                        '<b>' + title.name + ' </b></div>' +
                        '<div style=" width: 90%; float: left; clear: right;">' + value  + '</div>');
                }
            });
            return html.join('');
        }

        // atributos de filas
        function cellStyle(value, row, index, field) {
            return {
                css: {"white-space": "nowrap"}
            };
        }

        function dateFormat(value, row, index) {

            var date = new Date(value);

            var day = date.getDate().toString();
            day = day.length > 1 ? day : '0' + day;

            var month = (1 + date.getMonth()).toString();
            month = month.length > 1 ? month : '0' + month;

            var hours = date.getHours().toString();
            hours = hours.length > 1 ? hours : '0' + hours;

            var minutes = date.getMinutes().toString();
            minutes = minutes.length > 1 ? minutes : '0' + minutes;

            var seconds = date.getSeconds().toString();
            seconds = seconds.length > 1 ? seconds : '0' + seconds;

            return '<span>' + day + '-' + month + '-' + date.getFullYear() + '</span><br>' +
                '<span>' + hours + ':' + minutes + ':' + seconds + '</span>';
        }

        function updateRow(index, entity){

            $('#table').bootstrapTable('updateRow', {
                index: index,
                row: {
                    id: entity.id,
                    name: entity.name,
                    web : entity.web,
                    description : entity.description,
                    active : entity.active,
                    created_at : entity.created_at,
                    updated_at : entity.updated_at
                }
            });

            items[items.findIndex(item => item.id == entity.id)] = entity;
        }

        // function de registro
        $(function () {
            $('#form-create').submit(function (e) {
                lockSubmit();
                var form = new FormData(document.getElementById('form-create')[0]);
                var dataForm = $('#form-create').serialize();
                console.log(form);
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: '{{route('games.store')}}',
                    data: form,
                    success: function (data) {
                        console.log(data);
                        if (data.errors) {
                            showInputError(data.errors.name ? data.errors.name : null, '#error-name-create','#group-error-name-create');
                        }
                        if(data.status === 'success'){
                            showToastSuccess(data.message);
                            dissmisModal('#form-create','#modal-create');
                            $('#table').bootstrapTable('refresh');

                            unlockSubmit();
                        }
                    },
                    error: function (error) {
                        showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
                        dissmisModal('#form-create','#modal-create');
                    }
                });

                unlockSubmit();

            });
        });

        // mostrar errores de input formulario
        function showInputError(error, input, group){
            var label =  $(input);
            var divContent = $(group);

            label.html(error);
            divContent.addClass('has-error');

        }

        // esconder errores de input formularion
        function hideInputError(input, group){
            var label =  $(input);
            var divContent = $(group);

            label.html('');
            divContent.removeClass('has-error');
        }

        // limpia el campo de error cuando se escribe denuevo create
        $('#form-create').find('#name').keyup(function () {
            if($('#form-create').find('#name').val().length > 1){
                hideInputError('#error-name-create','#group-error-name-create');
            }
        });

        // limpia el campo de error cuando se escribe denuevo edit
        $('#form-edit').find('#name').keyup(function () {
            if($('#form-edit').find('#name').val().length > 1){
                hideInputError('#error-name-edit','#group-error-name-edit');
            }
        });


        // limpia el campo de error cuando se escribe denuevo edit
        $('#form-edit').find('#web').keyup(function () {
            if($('#form-edit').find('#web').val().length > 1){
                hideInputError('#error-web-edit','#group-error-web-edit');
            }
        });

        // limpiar input formularion crear
        function clearInputs(form){
            $(form).trigger('reset');
        }

        // esconder modal crear
        function hideModal(modal){
            $(modal).modal('hide');
        }

        // show modal crear
        function showModal(modal){
            $(modal).modal('show');
        }

        // cerrar y limpiar modal crear
        function dissmisModal(form, modal){
            clearInputs(form);
            hideModal(modal);
            removeHasErrors();
        }

        function removeHasErrors() {
            hideInputError('#error-name-create','#group-error-name-create');
            hideInputError('#error-name-edit','#group-error-name-edit');
            hideInputError('#error-web-edit','#group-error-web-edit');
        }

        // funcion de editar
        $(function () {
            $('#form-edit').submit(function (e) {

                lockSubmit();

                var dataForm = $('#form-edit').serialize();
                e.preventDefault();
                var url = '{{route('games.update')}}';
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: dataForm,
                    success: function (data) {

                        if (data.errors) {
                            showInputError(data.errors.name ? data.errors.name : null, '#error-name-edit','#group-error-name-edit');
                        }
                        if(data.status === 'success'){
                            $('#table').bootstrapTable('refresh');
                            showToastSuccess(data.message);
                            showToastWarning('Tenga en cuenta que la categoría de nodo que ha modificado puede estar siendo utilizado por nodos y este cambio será reflejado en estos.');
                            dissmisModal('#modal-create','#modal-edit');
                            updateRow(items.findIndex(item => item.id == data.entity.id), data.entity);
                        }
                    },
                    error: function (error) {
                        showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
                        dissmisModal('#modal-create','#modal-edit');
                    }
                });

                unlockSubmit();

            });
        });

        // boton de editar
        function operateFormatterControls(value, row, index){
            return ['<button onclick="showDataToEdit(' + row.id +')" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></button>',
                '<button onclick="remove(' + row.id +')" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button>'
            ].join('  ');
        }

        // muestra los valores de la fila en el form de editar
        function showDataToEdit(rowId){

            var item = items.filter(item => item.id === rowId)[0];

                showModal('#modal-edit');
            $('#form-edit').find('#id-edit').val(item.id);
            $('#form-edit').find('#name').val(item.name);
            $('#form-edit').find('#web').val(item.web);
            $('#form-edit').find('#description').val(item.description);


        }

        // boton de activar y desactivar item
        function operateFormatterActive(value, row, index){

            var activeButton = '';

            if(row.active == 1){
                activeButton = 'checked';
            }
            return ['<label class="switch"><input id="switch" type="checkbox" onclick="changeStatusToggle(' + row.id + ')" ' + activeButton + ' id="togBtn"><div class="slider round"><span class="on">Activado</span><span class="off">Desactivado</span></div></label>'].join('');
        }

        // cambia el estado del item ( activar y desactivar )
        function changeStatusToggle(rowId){

            var item = items.filter(item => item.id === rowId)[0];
            var itemStatus = item.active == 1 ? 0 : 1;

            $.ajax({
                type: 'POST',
                url: '{{route('games.change-status')}}',
                data: {
                    _token : '{{ csrf_token() }}',
                    id : item.id,
                    active : itemStatus
                },
                success: function (data) {
                    if (data.errors) {
                        showToastError(data.errors.name ? data.errors.name : '');
                    }
                    if(data.status === 'success'){

                        var status = data.entity.active == 1 ? "activado" : "desactivado";
                        showToastSuccess('Se ha ' + status + ' la categoría de nodo ' + data.entity.name);
                        if(status == 'desactivado'){
                            showToastWarning('Tenga en cuenta que la categoría de nodo que ha deshabilitado puede estar siendo utilizado por nodos y este dejará de aparecer como una opción seleccionable.');
                        }
                        updateRow(items.findIndex(item => item.id == data.entity.id), data.entity);
                    }
                },
                error: function (error) {
                    showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
                }
            });

        }

        // eliminar registro
        function remove(id){

            swal({
                title: '¿Estas seguro?',
                text: "Si eliminas esta categoría de nodo se perderán todas las relaciones actuales.",
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminar',
                cancelButtonText: 'No, Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then(function(result){

                if (result.value) {

                    var url = '{{route('games.destroy')}}';
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            _token : '{{ csrf_token() }}',
                            id : id
                        },
                        success: function (data) {

                            if (data.errors) {
                                showInputError(data.errors.name ? data.errors.name : null, '#error-name-edit','#group-error-name-edit');
                            }
                            if(data.status === 'success'){
                                showToastSuccess(data.message);
                                showToastWarning('Tenga en cuenta que la categoría de nodo que ha eliminado ya no puede ser referenciado.');
                                $('#table').bootstrapTable('refresh');
                            }
                        },
                        error: function (error) {
                            showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
                            dissmisModal('#modal-create','#modal-edit');
                        }
                    });

                    unlockSubmit();

                } else if (result.dismiss === swal.DismissReason.cancel) {
                    swal({
                        title: 'Cancelado',
                        text: 'Acción Cancelada.',
                        type: 'error',
                        confirmButtonText: 'De acuerdo',
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false
                    });
                }

        });

        }

    </script-->

    <script>

        config.csrf_token = "{{ csrf_token() }}";
        config.urlGetAll = "{{ route('games.all') }}";
        config.urlStore = " {{route('games.store')}}";
        config.urlUpdate = " {{ route('games.update') }}";
        config.urlDestroy = " {{ route('games.destroy') }}";
        config.urlChangeStatus = " {{ route('games.change-status') }}";

        config.rowTitles = [

            {id: 'id', name: 'Id'},
            {id: 'name', name: 'Juego'},
            {id: 'companies_id', name: 'Compañia'},
            {id: 'second_lastname', name: 'Apellido Materno'},
            {id: 'role.name', name: 'Rol'},
            {id: 'created_at', name: 'Creado'},
            {id: 'updated_at', name: 'Modificado'},
            {id: 'active', name: 'Estado'}
        ];

        config.errorsCreateValidate = [
            {name: 'name',   group: '#group-error-name-create',   label : '#label-error-name-create'},
            {name: 'companies_id' ,   group: '#group-error-companies_id-create',    label : '#label-error-companies_id-create'},
            {name: 'description', group: '#group-error-description-create', label : '#label-error-description-create'},
            {name: 'plataforms_id', group: '#group-error-plataforms_id-create', label : '#label-error-plataforms_id-create'},
            {name: 'categories_id', group: '#group-error-categories_id-create', label : '#label-error-categories_id-create'},
            {name: 'price', group: '#group-error-price-create', label : '#label-error-price-create'},
            {name: 'clasification', group: '#group-error-clasification-create', label : '#label-error-clasification-create'},
            {name: 'game_types_id', group: '#group-error-game_types_id-create', label : '#label-error-game_types_id-create'},
            {name: 'stock',  group: '#group-stock-stock-create',     label : '#label-error-stock-create'}
        ];

        config.errorsEditValidate = [
            {name: 'avatar',   group: '#group-error-avatar-edit',   label : '#label-error-avatar-edit'},
            {name: 'email' ,   group: '#group-error-email-edit',    label : '#label-error-email-edit'},
            {name: 'role_id',  group: '#group-error-role-edit',     label : '#label-error-role-edit'}
        ];

        function showDataToEdit(rowId){

            var item = items.filter(item => item.id === rowId)[0];

            showModal('#modal-edit');

            $('#form-edit').find('#id-edit').val(item.id);
            $('#form-edit').find('#name').val(item.name);
            $('#form-edit').find('#companies_id').val(item.companies_id);
            $('#form-edit').find('#description').val(item.description);
            $('#form-edit').find('#plataforms_id').val(item.plataforms_id);
            $('#form-edit').find('#categories_id').val(item.categories_id);
            $('#form-edit').find('#price').val(item.price);
            $('#form-edit').find('#clasification').val(item.clasification);
            $('#form-edit').find('#game_types_id').val(item.game_types_id);
            $('#form-edit').find('#email').val(item.email);
            $('#form-edit').find('#stock').val(item.stock);
            $('#form-edit').find('#image-avatar-edit').attr('src',item.avatar.replace("public/", "storage/"));

        }

        function hideModal(modal){
            $(modal).modal('hide');
            removeErrors();
        }

        function removeErrors() {
            $('#label-error-role-create').html('');
            $('#label-error-email-create').html('');
            $('#label-error-password-create').html('');
            $('#group-error-role-create').removeClass('has-error');
            $('#group-error-email-create').removeClass('has-error');
            $('#group-error-password-create').removeClass('has-error');
            $('#label-error-role-edit').html('');
            $('#label-error-email-edit').html('');
            $('#label-error-password-edit').html('');
            $('#group-error-role-edit').removeClass('has-error');
            $('#group-error-email-edit').removeClass('has-error');
            $('#group-error-password-edit').removeClass('has-error');
        }

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image-cover').attr('src', e.target.result);
                    $('#image-cover').attr('class', 'img-thumbnail');
                    $('.link-del').html('borrar');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURLEdit(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image-cover-edit').attr('src', e.target.result);
                    $('#image-cover-edit').height($('#image-cover-edit').width());
                    $('.link-del').html('borrar');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#file").change(function () {
            readURL(this);
        });

        $('#form-edit').find('#file-edit').change(function () {
            readURLEdit(this);
        });

        function deleteAvatarCreate() {
            $('#modal-create #image-cover').attr('src', '{{ Storage::url('covers/cover-default.png') }}');
            $('.link-del').html('');
            $("#modal-create #file").val('');
        }

        function deleteAvatarEdit() {
            $('#modal-edit #image-cover-edit').attr('src', '{{ Storage::url('covers/cover-default.png') }}');
            $('.link-del').html('');
            $("#modal-edit #file").val('');
        }

    </script>

@endsection
