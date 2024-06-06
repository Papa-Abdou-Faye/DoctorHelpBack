<style>
    .onglet a:active,
    .onglet .active,
    .onglet .active:focus,
    .onglet td a:hover{
        background: rgb(101, 209, 252)
    }
</style>
<div class="pageMed">
    <div class="onglet">
        <div >
            <table class="tablebar" style="width: 100%">
                <tr class="navbarcon" >
                    <td><a href="{{ route("infoDetail") }}" class="connav" >Information</a></td>
                     <td><a href="{{ route("consDetail") }}" class="connav">Dossiers</a></td>
                     <td><a href="{{ route("ordDetail") }}" class="connav">Ordonnance</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
