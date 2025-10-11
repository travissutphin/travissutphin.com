/**
 * Blog Image Optimizer
 * Converts PNG images to WebP format using Sharp
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
};

console.log('🎨 Blog Image Optimizer');
console.log('========================\n');

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

// Process each image
async function optimizeImages() {
  for (const file of files) {
    const inputPath = path.join(CONFIG.inputDir, file);
    const outputPath = inputPath.replace(/\.png$/i, '.webp');

    // Skip if WebP already exists (unless you want to re-optimize)
    if (fs.existsSync(outputPath)) {
      console.log(`⏭️  Skipped (already exists): ${file}`);
      continue;
    }

    try {
      // Get original file size
      const originalStats = fs.statSync(inputPath);
      const originalSize = originalStats.size;
      totalOriginalSize += originalSize;

      // Convert to WebP
      await sharp(inputPath)
        .webp({
          quality: CONFIG.quality,
          effort: CONFIG.effort,
        })
        .toFile(outputPath);

      // Get optimized file size
      const optimizedStats = fs.statSync(outputPath);
      const optimizedSize = optimizedStats.size;
      totalOptimizedSize += optimizedSize;

      // Calculate savings
      const savings = ((1 - optimizedSize / originalSize) * 100).toFixed(1);
      const originalKB = (originalSize / 1024).toFixed(0);
      const optimizedKB = (optimizedSize / 1024).toFixed(0);

      console.log(`✅ ${file}`);
      console.log(`   ${originalKB}KB → ${optimizedKB}KB (-${savings}%)\n`);

      successCount++;
    } catch (error) {
      console.error(`❌ Error processing ${file}:`);
      console.error(`   ${error.message}\n`);
      errorCount++;
    }
  }

  // Print summary
  console.log('\n========================');
  console.log('📊 Optimization Summary');
  console.log('========================\n');
  console.log(`✅ Successfully converted: ${successCount} images`);
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
    console.log(`   1. Verify image quality (spot check a few images)`);
    console.log(`   2. Commit: git add *.webp`);
    console.log(`   3. Push: git commit -m "optimize: convert blog images to WebP" && git push`);
  }
}

// Run optimization
optimizeImages().catch(error => {
  console.error('\n❌ Fatal error:', error);
  process.exit(1);
});
