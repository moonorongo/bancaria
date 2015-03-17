// Noticias App
Noticias = Backbone.View.extend({
        
        initialize: function() {
            var _this = this;
            
            this.$el = $('#sectionContainer');
            this.el = this.$el[0];
                    
            this.render();

            $("button#nuevaNoticia").click(function(){
                _this.nuevo();
            });
            
            this.initDT();
            
        }, // end initialize 
        
        events: {},
                
        nuevo: function(){
            this.model = new NoticiasModel();
            var _this = this;
            _this.modificarModel(true);
        },

        modificar: function(id) {
            var _this = this;
            this.model = new NoticiasModel();

            this.model.id = id;
            this.model.fetch({
                success: function(response){
                    _this.modificarModel(false);
                }
            })

        },

        modificarModel : function(isNew) {
            var title = (isNew)? 'Nuevo' : 'Editar';
            var _this = this;
            $('#listaNoticias').hide();
            $('#noticiasModificarContainer').show();
            
            noticiasModificarView = new NoticiasModificarView({
                model: _this.model
            });            

        },
        
        borrar: function(id){
            var _this = this; 
            
            wcat.jConfirm("Est&aacute; seguro?", function(){
                var m = new ClientesModel();
                m.id = _this.lastRowSelected;

                m.destroy({
                    success: function() {
                        // refresh DT
                        _this.oTable.fnStandingRedraw();
                    }
                });
            }); // jConfirm    
        },
        
        render: function() {
            this.$el.html($('#noticiasTemplate').html());
            return this;        
        },
                
        initDT : function() {
            var _this = this;
            var DTConfig = {
                "bJQueryUI": true,
                "oLanguage": {
                        "sInfo" : "Mostrando _START_ a _END_, de un total de _TOTAL_ registros",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sSearch" : "Buscar:",
                        "sProcessing": "Procesando...",
                        "sLoadingRecords": "Cargando...",
                        "sZeroRecords": "No se encontraron registros",
                        "sInfoEmpty": "No se encontraron registros",
                        "sEmptyTable": "No hay informacion disponible",
                        "oPaginate": {
                                "sFirst": '<i class="icon-step-backward"></i>',
                                "sPrevious": '<i class="icon-backward"></i>',
                                "sNext": '<i class="icon-forward"></i>',
                                "sLast": '<i class="icon-step-forward"></i>'
                            }
                },
                "bPaginate": true,
                "bFilter": true,
                "bServerSide": true,
                "bInfo": true,
                "bSort": true,
                "sDom": 'rt<"bottom"p>',
                "bAutoWidth": false ,
                "iDisplayLength": 24,
                "bLengthChange": false,
                "sPaginationType": "full_numbers",
                "bProcessing": true
            };
            
            var idContainer = 'datatable';

            
            DTConfig.aoColumnDefs = [
                {
                  "aTargets": [ 1 ],
                  "mData": null,
                  "bSortable" : false,
                  "mRender": function ( data, type, row ) {
                       return '<a href="#" onClick="noticias.modificar('+row.DT_RowId+')">Editar</a>';
                   }                
                }
            ];
            
            
            DTConfig.fnServerParams = function ( aoData ) {
                var codigoCategoria = $('#codigoCategoriaLista').val();
                aoData.push( { "name": "codigoCategoria", "value": codigoCategoria} );
                //if(fechaPedido != "" && !_.isUndefined(fechaPedido)) aoData.push( { "name": "fechaPedido", "value": wcat.swapDateFormat(fechaPedido)} );
            }
            
            DTConfig.sAjaxSource = 'noticias.php';
    
            DTConfig.fnCreatedRow = function(nRow, aData, iDataIndex ) {
                  if (aData["1"] == "0") { 
                      $(nRow).addClass('disabled');
                  }
            } // end fnCreatedRow
            
            
            this.oTable = $('#'+ idContainer,this.el).dataTable(DTConfig).fnSetFilteringDelay();
        
            $("select#codigoCategoriaLista").change(function(){
                _this.oTable.fnStandingRedraw();
            });

        } // end initDT
});





NoticiasModel = Backbone.Model.extend({
    idAttribute : "codigo" ,
        
    defaults : {
        "titulo" : "",
        "descripcion" : "",
        "fecha" : moment().format("YYYY-MM-DD"),
        "publicado" : 1,
        "cantidadLecturas" : 0,
        "activo" : 1,
        "listaCategorias" : [],
        "listaImagenes" : []
    },
    
    url : function() {
        var base = "noticias.php?action=noticiasModelCRUD";

        if (this.isNew()) return base;
        return base + "&codigo=" + this.id;
    },
    
    initialize: function(){
        // nothin here
    }
}); 








// Armar aca un NoticiasModificarView, que vaya a #noticiasModificarContainer... lalala lalala
NoticiasModificarView = Backbone.View.extend({
    
    initialize: function() {
        var _this = this;

        this.$el = $('#noticiasModificarContainer');
        this.el = this.$el[0];

        this.render();
        this.indexSection = 0;
        
        CKEDITOR.replace('descripcion',  {
            toolbar: 'Basic',
            uiColor: '#9AB8F3',
            height: 280,
            width: 753,
            forcePasteAsPlainText : true
        });
        
        $('#listaImagenes').sortable();

        
        swfu = new SWFUpload({
            // Backend Settings
            upload_url: "upload.php",
            post_params: {"PHPSESSID": globalConfig.SESSIONID},

            // File Upload Settings
            file_size_limit : "4 MB",   
            file_types : "*.jpg",
            file_types_description : "JPG Images",
            file_upload_limit : "0",

            // Event Handler Settings - these functions as defined in Handlers.js
            //  The handlers are not part of SWFUpload but are part of my website and control how
            //  my website reacts to the SWFUpload events.
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess,
            upload_complete_handler : uploadComplete,

            // Button Settings
            button_image_url : "../static/css/images/SmallSpyGlassWithTransperancy_17x18.png",
            button_placeholder_id : "spanButtonPlaceholder",
            button_width: 180,
            button_height: 18,
            button_text : '<span class="button">Seleccionar Imagenes</span>',
            button_text_style : '.button { font-family: Helvetica, Arial, sans-serif; font-size: 12pt; }',
            button_text_top_padding: 0,
            button_text_left_padding: 18,
            button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
            button_cursor: SWFUpload.CURSOR.HAND,
            
            // Flash Settings
            flash_url : "../static/js/lib/swfupload/swfupload.swf",

            custom_settings : {
                upload_target : "divFileProgressContainer"
            },
            
            // Debug Settings
            debug: false
        });            
        
    }, 

    events: {
        "click #aceptar": "aceptar",
        "click .cancelar": "cancelar",
        "click #anterior": "anterior",
        "click #siguiente": "siguiente",
        "click .closeButton" : "deleteImage"
    },
            
    deleteImage: function(e) {
        $(e.currentTarget).parent().remove();
    },
       
    siguiente: function(){
        if(this.indexSection < 3) {
            this.indexSection++;
            this.switchSection();
        }
    },

    anterior: function(){
        if(this.indexSection > 0) {
            this.indexSection--;
            this.switchSection();
        }
    },

            
    switchSection: function() {

        if(this.indexSection == 0) {
            this.$("#anterior").hide();
            this.$("#siguiente").show();
        } else if (this.indexSection == 3) {
            this.$("#anterior").show();
            this.$("#siguiente").hide();
        } else {
            this.$("#anterior").show();
            this.$("#siguiente").show();
        }
        
        var offsetSection = this.indexSection * 960;
        this.$('#noticiasModificarPanelContainer').animate({ left : '-'+ offsetSection +'px' });

    },
    


    aceptar: function(e){
            e.preventDefault(); // corta la propagacion de eventos.
            var _this = this;
            
            _this.saveModel();
            return false;
    },

            
    saveModel: function(e) {
        	
        var _this = this;
        var titulo = this.$("#titulo").val();
        var fecha = wcat.swapDateFormat(this.$("#fecha").val());
        var publicado = (this.$("#publicado").prop("checked"))? "1":"0";
        
        var descripcion = CKEDITOR.instances.descripcion.getData().replace(/\"/g, "\'");
        var listaCategorias = [];
        var listaImagenes = [];

        $(".categoria:checked").each(function(i,e){ 
            listaCategorias.push({ codigo : e.id });
        })

        var orden = 1;
        $('img.imageThumb').each(function(i,e){
            listaImagenes.push({ archivo : e.src.replace(/^.*(\\|\/|\:)/, ''), order : orden  });
            orden++;
        });

        _this.model.set({
            "titulo" : titulo,
            "descripcion" : descripcion,
            "fecha" : fecha,
            "publicado" : publicado,
            "listaCategorias" : listaCategorias,
            "listaImagenes" : listaImagenes
        }, {silent: true});
        

        wcat.waitDialog();
        _this.model.save({}, {
           success: function(response) {
               wcat.waitDialog(true);
               noticias.oTable.fnStandingRedraw();
               _this.cancelar(e);
           } // success
        });

    },


    cancelar: function(e) {
        if(!_.isUndefined(e)) e.preventDefault(); 

        this.undelegateEvents();
        $(this.el).removeData().unbind();
        this.unbind();

        $('#noticiasModificarContainer').empty();
        
        $('#listaNoticias').show();
        $('#noticiasModificarContainer').hide();
        
        return false;           
    },    


    render: function() {
        var html = _.template($('#noticiasModificarTemplate').html(), this.model.toJSON());
        this.$el.html(html);
        return this; 
    }
    
});














