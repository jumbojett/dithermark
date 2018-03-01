<div class="dither-controls-container controls-panel">
    <div>
        <label>Dithering algorithm
            <select v-model="selectedDitherAlgorithmIndex">
                <option v-for="(ditherAlgorithm, index) in ditherAlgorithms" v-bind:value="index">{{ ditherAlgorithm.title }}</option>
            </select>
        </label>
    </div>
    <div>
        <button v-on:click="ditherImageWithSelectedAlgorithm" v-show="!isLivePreviewEnabled">Transform</button>
    </div>
    <div class="histogram-super-container">
        <div class="histogram-container" style="width: <?= HISTOGRAM_COLOR_WIDTH.'px'; ?>; height: <?= HISTOGRAM_HEIGHT.'px'; ?>;">
            <canvas ref="histogramCanvas" width="<?= HISTOGRAM_COLOR_WIDTH; ?>" height="<?= HISTOGRAM_HEIGHT; ?>"></canvas>
        </div>
    </div>
    <div class="spread-content">
        <label>Color comparison mode
            <select v-model="selectedColorDitherModeId">
                <template v-for="colorDitherMode in [...colorDitherModes.values()]">
                    <option v-bind:value="colorDitherMode.id">{{colorDitherMode.title}}</option>
                </template>
            </select>
        </label>
    </div>
    <div>
        <label>Color palette
            <select v-model="selectedPaletteIndex">
                <option v-for="(palette, index) in palettes" v-bind:value="index">{{palette.title}}</option>
            </select>
        </label>
        <button class="shuffle-color-palette-button" title="Previous color palette" @click="changePalette(selectedPaletteIndex - 1)"><</button>
        <button class="shuffle-color-palette-button" title="Next color palette" @click="changePalette(selectedPaletteIndex + 1)">></button>
    </div>
    <div class="color-dither-number-of-colors-container">
        <label for="color_dither_num_colors_input">Number of colors</label>
            <input type="range" v-model="numColors" v-bind:min="numColorsMin" v-bind:max="numColorsMax" step="1" list="color_dither_num_colors_tickmarks" id="color_dither_num_colors_input" />
        <datalist id="color_dither_num_colors_tickmarks">
            <template v-for="n in (numColorsMax - numColorsMin + 1)">
                <option v-bind:value="n + numColorsMin - 1"></option>
            </template>
        </datalist>
        <input type="number" v-model="numColors" v-bind:min="numColorsMin" v-bind:max="numColorsMax" step="1" />
    </div>
    <div class="color-replace-super-container">
        <div class="color-replace-title-container">
            <h5 class="color-replace-title">Colors</h5>
        </div>
        <div class="colors-list-container" @dragover="handleColorDragover">
            <template v-for="(color, i) in colors">
                <div class="color-container" draggable="true" @dragstart="handleColorDragstart($event, i)" @dragover="handleColorDragover($event, i)" @drop="handleColorDrop($event, i)" @dragend="handleColorDragend" v-bind:class="{'dragged-over': shouldShowDragoverStyle(i), 'dragged': isBeingDragged(i), 'color-disabled': i >= numColors}">
                    <label v-bind:for="idForColorPicker(i)">{{i+1}}</label>
                    <input type="color" v-bind:id="idForColorPicker(i)" v-model="colorsShadow[i]" v-bind:disabled="i >= numColors" />
                </div>
            </template>
        </div>
    </div>
    <div>
        <button @click="randomizePalette">Randomize palette</button>
        <button @click="printPalette">Print palette</button>
    </div>
</div>   