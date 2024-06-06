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
                    <td><a href="{{ route("info") }}" class="connav" >Information</a></td>
                     <td><a href="{{ route("dossier") }}" class="connav">Dossiers</a></td>
                     <td><a href="{{ route("ordonnance") }}" class="connav">Ordonnance</a></td>
                     <td><a href="{{ route("paraclinique") }}" class="connav">Paraclinique</a></td>
                     <td><a href="{{ route("cM") }}" class="connav">Certificat</a></td>
                     <td><a href="{{ route("rv") }}" class="connav">rendez-vous</a></td>
                     <td><a href="{{ route("antecedent") }}" class="connav">Antecedents</a></td>
                     <td><a href="{{ route("terrain") }}" class="connav">Terrains</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
