import { execSync } from "child_process";
import fs from "fs";
import path from "path";
import archiver from "archiver";

const BUILD_DIR = path.join(process.cwd(), "public", "build");
const ZIP_FILE = path.join(process.cwd(), "public", "build.zip");


function runCommand(cmd) {
  console.log(`> ${cmd}`);
  execSync(cmd, { stdio: "inherit" });
}

function zipDirectory(sourceDir, outPath) {
  const archive = archiver("zip", { zlib: { level: 9 } });
  const stream = fs.createWriteStream(outPath);

  return new Promise((resolve, reject) => {
    archive
      .directory(sourceDir, "build")
      .on("error", err => reject(err))
      .pipe(stream);

    stream.on("close", () => resolve());
    archive.finalize();
  });
}

(async () => {
  try {
    console.log("📦 Running Vite build...");
    runCommand("npm run build");

    if (fs.existsSync(ZIP_FILE)) {
      console.log("🧹 Removing old build.zip...");
      fs.unlinkSync(ZIP_FILE);
    }

    console.log("🗜️ Zipping public/build directory...");
    await zipDirectory(BUILD_DIR, ZIP_FILE);

    console.log("✅ Done: build.zip is ready to be deployed!");
  } catch (err) {
    console.error("❌ Error during build-and-zip:", err.message);
    process.exit(1);
  }
})();