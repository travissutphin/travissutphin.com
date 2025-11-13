/**
 * Case Study Image Optimizer
 * Converts PNG images to WebP format using Sharp with responsive sizes
 *
 * Usage: node optimize-images.js
 */

const sharp = require('sharp');
const fs = require('fs');
const path = require('path');

// Configuration
const CONFIG = {
  inputDir: __dirname,
  quality: 85,
  effort: 6, // 0-6, higher = better compression but slower
  formats: ['.png'],
  responsiveSizes: [
    { suffix: '-600w', width: 600 },
    { suffix: '-900w', width: 900 },
    { suffix: '', width: null }, // Full size
  ],
};

console.log('🎨 Case Study Image Optimizer');
console.log('==============================\n');

// Get all PNG files in current directory
const files = fs.readdirSync(CONFIG.inputDir)
  .filter(f => CONFIG.formats.some(ext => f.toLowerCase().endsWith(ext)));

if (files.length === 0) {
  console.log('❌ No PNG files found in current directory');
  process.exit(1);
}

console.log(`📁 Found ${files.length} PNG images to optimize\n`);

// Track statistics
let totalOriginalSize = 0;
let totalOptimizedSize = 0;
let successCount = 0;
let errorCount = 0;
let filesCreated = 0;

// Process each image
async function optimizeImages() {
  for (const file of files) {
    const inputPath = path.join(CONFIG.inputDir, file);
    const baseName = file.replace(/\.png$/i, '');

    console.log(`🖼️  Processing: ${file}`);

    try {
      // Get original file size
      const originalStats = fs.statSync(inputPath);
      const originalSize = originalStats.size;
      totalOriginalSize += originalSize;

      // Create each responsive size
      for (const size of CONFIG.responsiveSizes) {
        const outputPath = path.join(
          CONFIG.inputDir,
          `${baseName}${size.suffix}.webp`
        );

        // Skip if WebP already exists
        if (fs.existsSync(outputPath)) {
          console.log(`   ⏭️  Skipped ${size.suffix || 'full'} (exists): ${path.basename(outputPath)}`);
          continue;
        }

        // Convert to WebP with optional resize
        let pipeline = sharp(inputPath);

        if (size.width) {
          pipeline = pipeline.resize(size.width, null, {
            fit: 'inside',
            withoutEnlargement: true,
          });
        }

        await pipeline
          .webp({
            quality: CONFIG.quality,
            effort: CONFIG.effort,
          })
          .toFile(outputPath);

        // Get optimized file size
        const optimizedStats = fs.statSync(outputPath);
        const optimizedSize = optimizedStats.size;
        totalOptimizedSize += optimizedSize;

        const optimizedKB = (optimizedSize / 1024).toFixed(0);
        const label = size.width ? `${size.width}w` : 'full';

        console.log(`   ✅ ${label}: ${optimizedKB}KB`);
        filesCreated++;
      }

      // Show savings for this image
      const imageOptimizedSize = CONFIG.responsiveSizes.reduce((sum, size) => {
        const outputPath = path.join(CONFIG.inputDir, `${baseName}${size.suffix}.webp`);
        if (fs.existsSync(outputPath)) {
          return sum + fs.statSync(outputPath).size;
        }
        return sum;
      }, 0);

      const savings = ((1 - imageOptimizedSize / originalSize) * 100).toFixed(1);
      const originalKB = (originalSize / 1024).toFixed(0);

      console.log(`   📊 ${originalKB}KB PNG → ${filesCreated} WebP files (-${savings}% total)\n`);

      successCount++;
    } catch (error) {
      console.error(`❌ Error processing ${file}:`);
      console.error(`   ${error.message}\n`);
      errorCount++;
    }
  }

  // Print summary
  console.log('\n==============================');
  console.log('📊 Optimization Summary');
  console.log('==============================\n');
  console.log(`✅ Successfully converted: ${successCount} images`);
  console.log(`📄 WebP files created: ${filesCreated}`);

  if (errorCount > 0) {
    console.log(`❌ Errors: ${errorCount} images`);
  }

  if (successCount > 0) {
    const totalOriginalMB = (totalOriginalSize / 1024 / 1024).toFixed(2);
    const totalOptimizedMB = (totalOptimizedSize / 1024 / 1024).toFixed(2);
    const totalSavings = ((1 - totalOptimizedSize / totalOriginalSize) * 100).toFixed(1);

    console.log(`\n📦 Original size: ${totalOriginalMB}MB`);
    console.log(`📦 Optimized size: ${totalOptimizedMB}MB`);
    console.log(`💾 Total savings: ${totalSavings}%`);
    console.log(`\n🎉 All images optimized successfully!`);
    console.log(`\n📝 Next steps:`);
    console.log(`   1. Verify image quality (open a few in browser)`);
    console.log(`   2. Stage files: git add *.webp`);
    console.log(`   3. Commit: git commit -m "optimize: convert case study images to WebP"`);
    console.log(`   4. Test case study page displays correctly`);
  }
}

// Run optimization
optimizeImages().catch(error => {
  console.error('\n❌ Fatal error:', error);
  process.exit(1);
});
