<div class="alert alert-success" role="alert" id="respon_server" style="display: none">
    <p class="message"></p>
</div>
<div class="block">
    <div class="header">
        <h2><?php echo $title ?></h2>
        <div class="side pull-right">
            <ul class="buttons">
                <li><a href="/master/address/addProvinsi"><span class="icon-plus"></span> Tambah Provinsi</a></li>
            </ul>
        </div>
    </div>
    <div class="content">
        <table id="example" class="display responsive nowrap table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th class="col-md-2">Kode Provinsi</th>
                <th>Nama Provinsi</th>
                <th class="col-md-2">Action</th>
            </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal modal-danger" tabindex="-1" role="dialog" id="model_remove">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Hapus Provinsi</h4>
            </div>
            <div class="modal-body clearfix">
                <p>Apakah anda setuju menghapus provinsi<h3 id="dataProvinsi"></h3></p>
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary pull-right" id="btnHapus" onclick="hapus()"
                            data-dismiss="modal">Setuju
                    </button>
                </div>
                <br>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var table = $('#example').DataTable({
            processing: true,
            ajax: {
                url: '<?php echo base_url()?>/master/province/getProvince',
                dataSrc: 'data.content',
                data: function(d,settings){
                    console.log(d);
                    var api = new $.fn.dataTable.Api( settings );
                    d.page = api.page.info().page;
                    d.size = d.length
                    d.search = d.search.value
                }
            },
            serverSide: true,
            columns: [
                {
                    data: "",
                    render: function (data, type, full) {
                        return full.code;
                    }
                },
                {
                    data: "",
                    render: function (data, type, full) {
                        return full.name;
                    }
                },
                {
                    data: "",
                    className: "center",
                    render: function (data, type, full) {
                        return '<a href="<?php echo base_url()?>master/address/editProvinsi/' + encodeURI(full.id) + '" class=" editor_edit"><span class="icon-edit"></span></a> | <a href="#" class=" editor_remove" onclick="showModalRemove(\'' + encodeURI(full.name) + '\',\'' + encodeURI(full.id) + '\')"><span class="icon-trash"></span></a>';
                    }
                }
            ],
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    });

    function showModalRemove(provinsi, id) {
        $("#dataProvinsi").html(provinsi);
        $("#btnHapus").attr('onclick', 'hapus("' + id + '")');
        $("#model_remove").modal('show');
    }

    function show_notif(tipe, message) {
        if (tipe == 201 || tipe == 200) {
            $("#respon_server").attr('class', 'alert alert-success');
        } else {
            $("#respon_server").attr('class', 'alert alert-danger');
        }
        $("#respon_server .message").html(message);
        $("#respon_server").show('slow');
    }

    function hapus(id) {
        var id = id;

        var data = {
            id: id
        }

        var dataSend = {
            data: JSON.stringify(data)
        }

        $.ajax({
            type: "POST",
            url: "/master/province/deleteProvince",
            data: dataSend,
            success: function (data) {
                var data = JSON.parse(data);
                show_notif(data.code, data.message);
                setTimeout(function () {
                    location.reload();
                }, 3000);
            }
        })
    }

</script>