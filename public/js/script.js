//button success
let button_list_mahasiswa = '<a role="button" class="btn btn-primary px-2" href="asiap">\
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">\
<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>\
<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>\
</svg>\
Detail\
</a>';
//button hapus
let button_hapus = '<a role="button" class="btn btn-danger px-4" href="krs/hapus/asiap">\
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">\
<path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>\
<path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>\
</svg>\
Hapus\
</a>';

//ajax pada krs
function tabel_krs(url_ajax,document,first){
  let element_html = $(document);
  element_html.load(url_ajax, (response,textStatus)=>{
    element_html.empty();
    if(textStatus=='success'){
      let hasil = JSON.parse(response);
      let btn = '';
      var total_sks = 0;
      if(hasil.length>0){
        hasil.forEach((element,index) =>{
            if(element.status=="Disetujui"){
               btn = button_list_mahasiswa;
            }else {
               btn = button_hapus;
            }
            element_html.append(row_str([index+1,[
              element.kode,
              element.nama_mata_kuliah,
              element.sks,
              element.status
            ]]).replace('</tr>','<td>'+btn.replace('asiap',element.id)+'</td></tr>'));
            total_sks += element.sks;
            if(first) {
              console.log(total_sks);
              localStorage['krs_len'] = total_sks;
            }
        });
      }else{
        localStorage['krs_len'] = "0";
        element_html.append(
          '<tr>\
              <td colspan="6" align="center"> Kamu Belum Mengambil KRS di Semester Ini ! </td>\
          </tr>'
        );
      }
    }
  });
}

//mencari data menggunakan ajax
function ajax_search(document,route,column_size){
    html_element = $(document);
    html_element.load(route, function(response,textStatus){
        if(textStatus=='success'){
          let response_json = JSON.parse(response);
          fetch_tabel(response_json,html_element,column_size);
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
  var krs_len = parseInt(localStorage['krs_len']);
  if($('#'+id).hasClass("btn-success" )){
    if(krs_len+Number($('#sks-'+id).val()) > krs_maks){
        alert('tidak bisa');
    }else {
        $('#'+id).removeClass( "btn-success" ).addClass('btn-danger').text('Hapus');
        krs_cache.push(Number($('#'+id).val()));
        krs_len += Number($('#sks-'+id).val());
        console.log(krs_len);
    }
  }else {
    $('#'+id).removeClass( "btn-danger" ).addClass('btn-success').text('Tambah');
    krs_cache.pop(Number($('#'+id).val()));
    krs_len -= Number($('#sks-'+id).val()); 
    console.log(krs_len);

  }
  localStorage['krs'] = JSON.stringify({list:krs_cache,max:krs_maks});
  localStorage['krs_len'] = krs_len;
}

//fungsi untuk tombol ajukan pada tambah krs
function krs_ajukan(){
  if(typeof localStorage['krs'] !== 'undefined'){
    var list = JSON.parse(localStorage['krs']).list;
    var semester = localStorage['semester'];
    $('#listKrs').attr('value',list.join(','));
    $('#semesterKrs').attr('value',semester);
    localStorage.clear();
  }else {
      alert('Data Masih Kosong Silahkan diisi terlebih dahulu !');
  }
}

//memasukan data ke dalam tabel
function fetch_tabel(data,html_element,column_size){
  html_element.empty();
  if(data.length == 0){
    $(html_element).append(
      '<tr><td colspan="size" align="center"> Pencarian Tidak Ditemukan ! </td></tr>'
      .replace('size',column_size)
    );

  }else {
    data.forEach((element,index) => {
      $(html_element).append(row_str([index+1,element]));
    });
  }
}

function tabel_khs(url_ajax,document){
  let element_html = $(document);
  element_html.load(url_ajax, (response,textStatus)=>{
    element_html.empty();
    if(textStatus=='success'){
      let hasil = JSON.parse(response);
      var total_sks = 0;
      if(hasil.length>0){
        hasil.forEach((element,index) =>{
            element_html.append(row_str([index+1,[
              element.kode,
              element.nama_mata_kuliah,
              element.nilai
            ]]).replace('</tr>','<td>'+button_list_mahasiswa.replace('asiap','/khs/detail/'+element.id)+'</td></tr>'));
            total_sks += element.sks;
        });
      }else{
        localStorage['krs_len'] = "0";
        element_html.append(
          '<tr>\
              <td colspan="5" align="center"> Kamu Belum Mengambil KRS di Semester Ini ! </td>\
          </tr>'
        );
      }
    }
  });
}