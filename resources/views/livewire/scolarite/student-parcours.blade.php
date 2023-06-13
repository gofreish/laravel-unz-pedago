<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <!-- Licence -->
    <table id="student-parcours" class="table">
        <thead>
            <tr>
                <th>Licence</th>
                <th>Master</th>
                <th>Doctorat</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php
                        for ($i=1; $i <= 6; $i++) { 
                            echo("
                                <div class='input-group mb-3'>
                                    <span class='input-group-text' id='basic-addon1'>S".$i."</span>
                                    <input wire:model='parcours.s".$i.".result' type='radio' class='btn-check' value='v' name='s.".$i.".' id='s".$i."_V' autocomplete='off'>
                                    <label class='btn btn-outline-primary' for='s".$i."_V'>Validé</label>
                                    <input wire:model='parcours.s".$i.".result' type='radio' class='btn-check' value='a' name='s.".$i.".' id='s".$i."_A' autocomplete='off'>
                                    <label class='btn btn-outline-danger' for='s".$i."_A'>Ajourné</label>
                                    <input wire:model='parcours.s".$i.".result' type='radio' class='btn-check' value='n' name='s.".$i.".' id='s".$i."_N' autocomplete='off'>
                                    <label class='btn btn-outline-secondary' for='s".$i."_N'>A venir</label>
                                    <input wire:model='parcours.s".$i.".times' type='number' style='width: 10%;'>
                                    fois
                                </div>
                                "
                            );
                        }
                    ?>
                </td>
                <td>
                    <?php
                        for ($i=1; $i <= 4; $i++) { 
                            echo("
                                <div class='input-group mb-3'>
                                    <span class='input-group-text' id='basic-addon1'>M".$i."</span>
                                    <input wire:model='parcours.m".$i.".result' type='radio' class='btn-check' value='v' name='m.".$i.".' id='m".$i."_V' autocomplete='off'>
                                    <label class='btn btn-outline-primary' for='m".$i."_V'>Validé</label>
                                    <input wire:model='parcours.m".$i.".result' type='radio' class='btn-check' value='a' name='m.".$i.".' id='m".$i."_A' autocomplete='off'>
                                    <label class='btn btn-outline-danger' for='m".$i."_A'>Ajourné</label>
                                    <input wire:model='parcours.m".$i.".result' type='radio' class='btn-check' value='n' name='m.".$i.".' id='m".$i."_N' autocomplete='off'>
                                    <label class='btn btn-outline-secondary' for='m".$i."_N'>A venir</label>
                                    <input wire:model='parcours.m".$i.".times' type='number' style='width: 10%;'>
                                    fois
                                </div>
                                "
                            );
                        }
                    ?>
                </td>
                <td>
                    <div class='input-group mb-3'>
                        <span class='input-group-text' id='basic-addon1'>En cours</span>
                        <input wire:model='parcours.d.result' type='radio' class='btn-check' value='true' name='d' id='d_V' autocomplete='off'>
                        <label class='btn btn-outline-primary' for='d_V'>Oui</label>
                        <input wire:model='parcours.d.result' type='radio' class='btn-check' value='false' name='d' id='d_A' autocomplete='off'>
                        <label class='btn btn-outline-danger' for='d_A'>Non</label>
                    </div>
                    <div class='input-group mb-3'>
                        <label class='label' for='d_A'>Depuis</label>
                        <input wire:model='parcours.d.times' type='number' value='0' style='width: 30%;'>
                        <label class='label' for='d_A'>An(s)</label>
                    </div>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td class="text-center">
                    <input type="text" name="historique" wire:model="historique" hidden>
                </td>
            </tr>
        </tfoot>
    </table>
    
</div>
