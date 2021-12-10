//ajax pada krs
function tabel_krs(url_ajax){
    $.ajax({
      type:"GET",
      url: url_ajax,
      dataType: "json",
      success: function(response){
        // console.log(response.krs);
        if(response.krs.length > 0){
          $.each(response.krs, function(key, item){
            var button = "";
            if(item.status == "Disetujui"){
              button = '<a role="button" class="btn btn-primary px-2" href="'+'//'+'">\
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">\
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>\
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>\
                </svg>\
                List Mahasiswa\
                </a>';
            }else {
              button = '<a role="button" class="btn btn-danger px-4" href="'+'//'+'">\
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">\
                <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>\
                <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>\
                </svg>\
                Hapus\
                </a>';
            }
            $('tbody').append(
              '<tr>\
                <th scope="row">'+ (key+1) +'</th>\
                <td>'+item.kode+'</td>\
                <td>'+item.nama_mata_kuliah+'</td>\
                <td>'+item.sks+'</td>\
                <td>'+item.status+'</td>\
                <td>'+button+'</td>\
              </tr>'

            );
          });
        }else {
          $('tbody').append(
              '<tr>\
                <td colspan="6" align="center"> Kamu Belum Mengambil KRS di Semester Ini ! </td>\
              </tr>'

          );
        }
        
      }
    });
  }

//mencari data menggunakan ajax
function ajax_search(document,route){
    let html_element = $(document);
    html_element.load(route,function(response,textStatus){
        if(textStatus=='success'){
          let response_json = JSON.parse(response);
          html_element.empty();
          if(response_json.length==0){
            $(html_element).append('<tr><td colspan="6" align="center"> Pencarian Tidak Ditemukan ! </td></tr>');
          }else {
            response_json.forEach((element,index) => {
              $(html_element).append(row_str([index+1,element]));
            });
          }

        }
    });
}

//generate string untuk fetch row pada tabel
function row_str(arr){
  let string = '<tr><th scope="row">'+ arr[0] +'</th>';
  Object.values(arr[1]).forEach(element =>{
    string += '<td>'+element+'</td>';  
  });
  string += '</tr>';
  return string;
}

// fungsi untuk mengubah tombol dan menambahkan value ke localStorage
function krs_tambah(id){
  var krs_cache = JSON.parse(localStorage['krs']).list; 
  var krs_maks = JSON.parse(localStorage['krs']).max;
  var krs_len = JSON.parse(localStorage['krs']).len;
  if($('#'+id).hasClass("btn-success" )){
    if(krs_len == krs_maks){
        alert('tidak bisa');
    }else {
        $('#'+id).removeClass( "btn-success" ).addClass('btn-danger').text('Hapus');
        krs_cache.push(Number($('#'+id).val()));
        krs_len += Number($('#sks-'+id).val());
    }
  }else {
    $('#'+id).removeClass( "btn-danger" ).addClass('btn-success').text('Tambah');
    krs_cache.pop(Number($('#'+id).val()));
    krs_len -= Number($('#sks-'+id).val()); 
  }
  localStorage['krs'] = JSON.stringify({list:krs_cache,max:krs_maks,len:krs_len});
}

//fungsi untuk tombol ajukan pada tambah krs
function krs_ajukan(){
  if(typeof localStorage['krs'] !== 'undefined'){
    var list = JSON.parse(localStorage['krs']).list;
    var semester = localStorage['semester'];
    $('#list-krs').attr('value',list.join(','));
    $('#semester-krs').attr('value',semester);
    localStorage.clear();
  }else {
      alert('Data Masih Kosong Silahkan diisi terlebih dahulu !');
  }
}