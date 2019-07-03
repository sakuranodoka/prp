@extends('body')

<!--Article css, in the future it's mine-->
@section('css')
    <style>
        #drop_file_zone {
            background-color: #f1f2fa; 
            border-radius: 0px;
            border: #12ab87 1px dashed;

            height: 200px;
            padding: 8px;
            font-size: 18px;
        }
        #drag_upload_file {
            width:50%;
            margin:0 auto;
        }
        #drag_upload_file p {
            text-align: center;
        }
        #drag_upload_file #selectfile {
            display: none;
        }
    </style>
@endsection

@section('content')

    <div class="row" style=margin-top:1em>
        <div class="col m12 left-align">
            <!-- <h5>(Selection zone)</h5> -->
            <span style=color:gray>(ผลลัพธ์จากการอัปโหลดรูปภาพจะอยู่ทางฝั่งขวา)</span>
            <!-- <a data-target="modal1" class="waves-effect waves-light modal-trigger btn-small white-text" style="width:145px;border-radius:2em;background:#12ab87"><i class="material-icons left">add</i> สร้างรายการ</a> -->
        </div>
    </div>
    
    <!--Cluster content-->
    <div data-role=clusters>
        <div class=row>
            <div class="col m6">
                <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false" class="z-depth-2">
                    <div id="drag_upload_file" style=width:100%>
                        <p class="valign-wrapper" style="color:gray;justify-content: center"><i class="material-icons">attach_file</i> ลากไฟล์ลงที่นี่เพื่ออัปโหลด</p>
                        <p>หรือ</p>
                        <p><input type="button" value="Select File" onclick="file_explorer();"></p>
                        <input type="file" id="selectfile" />
                    </div>
                </div>
            </div>
            <div class="col m6">
                <p style=color:gray>Output :</p>
                

                <!-- display -->
                <div data-role="displays">
                </div>
            </div>
        </div>

        
    </div>

     <!--Modal Structure-->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Modal Header</h4>
            <p>A bunch of text</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat" ><i class="material-icons left" style=color:#12ab87>done</i> Saves</a>
        </div>
    </div>
  
@endsection

@section('js')
    <script>
        // preloaders templated
        const preloaders = 
            `<span data-role=pre-loader style=margin-left:1em>
                <div class="preloader-wrapper small active" style="width:24px;height:24px;">
                    <div class="spinner-layer spinner-green-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div><div class="gap-patch">
                            <div class="circle"></div>
                        </div><div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </span>`;

        // deleter icons that's you can remove some picture
        const deleters = 
            `<i class="material-icons red-text lighten-3">delete</i>`
        
        // statusior mention yr status `success` or `failure`
        const statusior = 
            `<i class="material-icons" style=color:#12ab87>done</i>`

        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems, null);
        });

        var fileobj;

        const upload_file = async function(e) {
            e.preventDefault()

            const displays = document.querySelector('[data-role=displays]')

            const referrences_id = 0

            // Synchonous => สร้าง Panel รออัปไฟล์เสร็จ
            // สร้าง interface
            Array.from(e.dataTransfer.files).forEach(file => {
                let inner_content = `<span>${file.name}</span> ${preloaders}`

                let panels_old = document.querySelector(`[data-name="${file.name}"]`)
                if (panels_old == null)
                    displays.innerHTML+= `<div data-name="${file.name}" data-id="${referrences_id}" class=valign-wrapper>${inner_content}</div>`
                else {
                    panels_old.innerHTML = inner_content
                }
            })

            // upload file (asynchonus)
            // ส่งข้อมูล แล้วเอาข้อมูลที่ได้ ไปแมปกับ interface ด้านบน
            // ที่ทำแยกเพราะจะได้ไม่ต้องรอกัน จบปิ้ง
            Array.from(e.dataTransfer.files).forEach(async function(file) {
                let res = await sended(file, referrences_id)

                // res.id = id ที่ระบบจ่ายมา
                // res.message = '...'

                if (!res.error) {
                    document.querySelector(`[data-name="${file.name}"]`).querySelector('[data-role=pre-loader]').innerHTML = `${statusior} ${deleters}`

                    document.querySelector(`[data-name="${file.name}"]`).dataset.id = res.id
                } else {
                    console.error('ไม่สำเร็จ', res)
                    document.querySelector(`[data-name="${file.name}"]`).querySelector('span').style.opacity = '0.2'

                    document.querySelector(`[data-name="${file.name}"]`).innerHTML+= ` <span style=color:gray;margin-left:1em>"ไม่สำเร็จ : ${res.message}"</span>`

                    document.querySelector(`[data-name="${file.name}"]`).dataset.name = 'undefined'

                    setTimeout(function() { 
                        document.querySelector(`[data-name="${file.name}"]`).remove()
                    }, 7000);
                }
            })
        }

        /**
         * ฟังก์ชันที่ใช้อัปโหลดรูปภาพ
         *
         * @var file = ไฟล์ที่อัปโหลด
         * id = ไอดีของภาพนั้น ผูกกับ Database
         */
        const sended = async function (file, id) {
            // Sended => to server 
            const formData = new FormData()
            formData.append('files', file)
            formData.append('id', id)

            return fetch('{{ url()->current() }}/uploading', {
                method: 'post', 

                // data can be `string` or {object}!
                body : formData, 
   
                // content type => false
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', 
                    'pragma': 'no-cache',
                    'cache-control': 'no-cache'
                }
            })
            // .then(res => res.json())
            .then(res => res.json())
            .then(res => {
                if (res.error == true) {
                    console.log('errors disappears : ', res.message)
                    return res
                } else {
                    console.log(`success : `, res)
                    return res
                }
            })
            .catch(error => {
                let res = {}
                res.error = true
                res.message = error
                console.error('Error:', error)

                return res
            })
        }
        
        function file_explorer() {
            document.getElementById('selectfile').click();
            document.getElementById('selectfile').onchange = function() {
                fileobj = document.getElementById('selectfile').files[0];
            ajax_file_upload(fileobj);
            };
        }
        
        async function ajax_file_upload(file_obj) {
            if (file_obj != undefined) {
                let form_data = new FormData()
                form_data.append('file', file_obj)

                $.ajax({
                    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }, 
                    type: 'POST', 
                    url: '{{ url()->current() }}/uploading', 
                    contentType: false, 
                    processData: false, 
                    data: form_data, 
                    success:function(response) {
                        alert(response);
                        $('#selectfile').val('');
                    }
                });
            }
        }

    </script>
@endsection