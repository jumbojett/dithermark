<div class="dither-controls-container controls-panel">
    <div>
        <label>Dithering algorithm
            <select v-model="selectedDitherAlgorithmIndex">
                <option v-for="(ditherAlgorithm, index) in ditherAlgorithms" v-bind:value="index">{{ ditherAlgorithm.title }}</option>
            </select>
        </label>
    </div>
    <div>
        <label>
            Lightness threshold
            <input type="number" v-bind:min="thresholdMin" v-bind:max="thresholdMax" v-model.number="threshold"/>
            <input type="range" v-bind:min="thresholdMin" v-bind:max="thresholdMax" v-model.number="threshold"/>
        </label>
    </div>
    <div>
        <button v-on:click="ditherImageWithSelectedAlgorithm" v-show="!isLivePreviewEnabled">Transform</button>
    </div>
    <div class="histogram-super-container">
        <div class="histogram-container" style="width: <?= HISTOGRAM_BW_WIDTH.'px'; ?>; height: <?= HISTOGRAM_HEIGHT.'px'; ?>;">
            <canvas ref="histogramCanvasIndicator" class="histogram-canvas-indicator" width="<?= HISTOGRAM_BW_WIDTH; ?>" height="<?= HISTOGRAM_HEIGHT; ?>"></canvas>
            <canvas ref="histogramCanvas" class="histogram-canvas" width="<?= HISTOGRAM_BW_WIDTH; ?>" height="<?= HISTOGRAM_HEIGHT; ?>"></canvas>
        </div>
    </div>

    <div class="color-replace-super-container">
        <div class="color-replace-title-container">
            <h5 class="color-replace-title">Color substitution</h5>
        </div>
        <label>Black<input type="color" v-model="colorReplaceColors[0]" /></label>
        <label>White<input type="color" v-model="colorReplaceColors[1]" /></label>
        <button v-on:click="resetColorReplace" v-show="areColorReplaceColorsChangedFromDefaults">Reset colors</button>
    </div>
    <div>
        <button v-on:click="saveTexture">Save texture</button>
        <button v-show="savedTextures.length >= 3" v-on:click="combineDitherTextures">Combine textures</button>
    </div>
</div>