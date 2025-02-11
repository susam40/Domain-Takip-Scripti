<?php require 'header.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                <h5 class="font-weight-bold text-primary">Müşteri Ekle</h5>
            </div>
            <div class="card-body">
                <form action="islemler/ajax.php" method="POST" accept-charset="utf-8">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Müşteri İsim</label>
                            <input type="text" name="musteri_isim" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Müşteri Mail</label>
                            <input type="email" name="musteri_mail" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Müşteri Telefon</label>
                            <input type="text" name="musteri_telefon" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Müşteri Detay</label>
                            <textarea name="musteri_detay" class="form-control" style="height: auto;"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="musteriekle">Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>