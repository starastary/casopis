@extends('layout')

@section('title', 'Nový příspěvek')

@section('content')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <div class="" style="display: grid; place-content: center;width: 100%; min-height: 100vh">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/post" class="w-screen" enctype="multipart/form-data">
        @csrf
        <div class="p-3">

            <div class="p-3 flex flex-col md:flex-row">
                <!-- Název -->
                <div class="flex flex-col lg:flex-row w-full items-center justify-between lg:mt-8 m-2">
                    <div class="flex flex-col justify-start mx-6 w-full  mt-2">
                        <label for="name" class="text-2xl mb-2">Název:</label>
                        <input id="name" class="rounded-lg px-5 py-3 text-lg border border-primary-700" type="text" name="name" value="{{old('name')}}" required autofocus />
                    </div>
                </div>

                <!-- Náhledovka -->
                <div class="flex flex-col lg:flex-row w-full items-center justify-between lg:mt-8 m-2">
                    <div class="flex flex-col justify-start mx-6 w-full  mt-2">
                        <label for="img" class="text-2xl mb-2">Náhledový obrázek:</label>
                        <input type="file" id="img" name="img" value="{{old('img')}}"
                               accept=".png,.jpg">
                    </div>
                </div>
            </div>
            <div class="p-3 flex flex-col md:flex-row md:items-center">
                <!-- Krátký -->
                <div class="flex flex-col lg:flex-row w-full items-center justify-between lg:mt-8 m-2">
                    <div class="flex flex-col justify-start mx-6 w-full  mt-2">
                        <label for="short" class="text-2xl mb-2">Náhled textu:</label>
                        <input id="short" class="rounded-lg px-5 py-3 text-lg border border-primary-700" type="text" name="short" value="{{old('short')}}" />
                    </div>
                </div>
                <div class="flex flex-col justify-start mx-6 w-full  mt-2">
                    <label for="stags" class="text-2xl mb-2">Tagy:</label>
                    <select name="tags[]" id="tags"  class="rounded-lg px-5 py-3 text-lg border border-primary-700" multiple>
                        <option disabled>Nový</option>
                        @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>



            <!-- Text -->
            <div class="w-full flex flex-col">
                <label for="text" class="text-2xl mb-2">Text:</label>
                <textarea id="text" class="rounded-lg pt-2"
                          name="text">
                    {{old('text')}}
                    </textarea>
            </div>

            <div class="w-full flex flex-col w-max mx-auto mt-6">
                <div class="flex">
                    <input type="checkbox" id="completed" name="completed" class="mr-2">
                    <label for="completed">Hotovo</label>
                </div>
                <div class="flex">
                    <input type="checkbox" id="editor_checked" name="editor_checked" class="mr-2">
                    <label for="editor_checked">Kontrola Editora</label>
                </div>
                <div class="flex">
                    <input type="checkbox" id="chief_checked" name="chief_checked" class="mr-2">
                    <label for="chief_checked">Kontrola Šéfredaktora</label>
                </div>
            </div>
        </div>

        <button type="submit" class="block m-auto uppercase font-bold text-2xl text-white mt-10 py-4 px-16 bg-green-500 rounded-lg shadow-lg hover:shadow-2xl hover:bg-green-600 transition">
            Vytvořit
        </button>
            <a href="{{route('dashboard')}}" class="mt-5 underline text-gray-500 hover:text-gray-700 m-auto block w-max">Zpět</a>
        </form>


        <script>
            tinymce.init({
                selector: 'textarea',

                image_class_list: [
                    {title: 'img-responsive', value: 'img-responsive'},
                ],
                height: 500,
                setup: function (editor) {
                    editor.on('init change', function () {
                        editor.save();
                    });
                },
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu imagetools",
                    "powerpaste media mediaembed advcode a11ychecker tinymcespellchecker image"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image advcode a11ycheck",

                image_title: true,
                automatic_uploads: true,
                images_upload_url: '/post/img',
                file_picker_types: 'image',
                file_picker_callback: function(cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function() {
                        var file = this.files[0];

                        var reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = function () {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), { title: file.name });
                        };
                    };
                    input.click();
                }
            });

            const newTag = () => {
                const name = prompt('Název tagu: ');

                if (!name) {
                    return
                }

                fetch(`http://127.0.0.1:8000/post/tag/${name}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data)
                        if (data == 'Tag již existuje') {
                            confirm('tag již existuje')
                            return
                        }
                        document.getElementById('tags').innerHTML += `<option value="${data.id}">${data.name}</option>`
                    });

            }

            window.onmousedown = function (e) {
                var el = e.target;
                if (el.tagName.toLowerCase() == 'option' && el.parentNode.hasAttribute('multiple')) {
                    e.preventDefault();
                    if (el.innerHTML == "Nový") {
                        newTag()
                        el.setAttribute('selected', '');
                        return;
                    }
                    // toggle selection
                    if (el.hasAttribute('selected')) el.removeAttribute('selected');
                    else el.setAttribute('selected', '');

                    // hack to correct buggy behavior
                    var select = el.parentNode.cloneNode(true);
                    el.parentNode.parentNode.replaceChild(select, el.parentNode);
                }
            }
        </script>
    </div>
@endsection
