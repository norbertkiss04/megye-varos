$(document).ready(function () {
    const $form = $('#form');
    const $contx = $('.contx');
    const $addVarosFormInner = $('#addVarosFormInner');

    $contx.on('click', '.element .content', handleCityNameClick);
    $contx.on('click', '.btn', handleButtonClick);
    $addVarosFormInner.submit(handleAddVaros);

    $form.change(function handleMegyeSelection() {
        const megyeValue = $(this).val();
        const url = `/varos/${megyeValue}`;

        $('#addVarosContainer').removeClass('d-none')

        $.getJSON(url).done(function (result) {
            $contx.empty();
            (result.varosok).forEach(function(varos) {
                const element = createVarosElement(varos);
                $contx.append(element);
            });
        })
    })

    function createVarosElement(varos) {
        return `
            <div class="element d-flex flex-md-row flex-column justify-content-md-between justify-content-center align-items-center p-3 border bg-light" data-id="${varos.id}">
                <div class="content">${varos.nev}</div>
                <div class="actions d-none m-0 pt-md-0 pt-3">
                    <button class="btn btn-danger btn-sm me-2" data-action="delete"><i class="bi bi-trash"></i> Törlés</button>
                    <button class="btn btn-warning btn-sm me-2" data-action="edit"><i class="bi bi-pencil"></i> Módosítás</button>
                    <button class="btn btn-secondary btn-sm" data-action="cancel"><i class="bi bi-x"></i> Mégse</button>
                </div>
            </div>
        `;
    }

    function handleCityNameClick() {
        const $content = $(this);
        const $element = $content.closest('.element');
        const currentName = $content.text();
        $content.replaceWith(`<input type="text" class="form-control edit-input" style="max-width: 350px;"  value="${currentName}" data-original-name="${currentName}" />`);
        $element.find('.actions').removeClass('d-none');
    }


    function handleButtonClick() {
        const action = $(this).data('action');
        const $element = $(this).closest('.element');
        const varosId = $element.data('id');

        switch (action) {
            case 'delete':
                deleteVaros(varosId, $element);
                break;
            case 'edit':
                saveChanges(varosId, $element);
                break;
            case 'cancel':
                cancelEdit($element);
                break;
        }
    }

    function deleteVaros(varosId, $element) {
        $.ajax({
            url: `/deleteVaros/${varosId}`,
            type: 'GET',
            success: function(response) {
                console.log('Delete successful:', response);
                $element.remove();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Delete failed:', textStatus, errorThrown);
            }
        });
    }

    function saveChanges(varosId, $element) {
        const newName = $element.find('input').val();
        $.ajax({
            url: `/modifyVaros/${varosId}`,
            type: 'POST',
            data: {
                newName: newName,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('Update successful:', response);
                $element.find('input').replaceWith(`<div class="content">${newName}</div>`);
                $element.find('.actions').addClass('d-none');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Update failed:', textStatus, errorThrown);
            }
        });
    }

    function cancelEdit($element) {
        const originalName = $element.find('input').data('original-name');
        $element.find('input').replaceWith(`<div class="content">${originalName}</div>`);
        $element.find('.actions').addClass('d-none');
    }


    function handleAddVaros(event) {
        event.preventDefault();
        const newVarosData = {
            nev: $('#varosName').val(),
            megye_id: $('#form').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: '/addVaros',
            type: 'POST',
            data: newVarosData,
            success: function(response) {
                if (response.success) {
                    console.log('Add successful:', response);
                    const newElement = createVarosElement(response.varos);
                    $contx.append(newElement);
                    $addVarosFormInner[0].reset();
                } else {
                    console.log('Add failed:', response);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Request failed:', textStatus, errorThrown);
            }
        });
    }
});
