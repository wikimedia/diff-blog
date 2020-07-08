#!/bin/python
import os.path as path
import os, re, sys, shutil, zipfile
from distutils.dir_util import copy_tree

ORIGINAL_DIRECTORY = path.abspath(path.join(__file__ , "../.."))
WORKING_DIRECTORY = path.abspath(path.join(__file__ , "../out/miniorange-oauth-client"))
AUTOLOAD = path.abspath(path.join(WORKING_DIRECTORY, "_autoload.php"))
SETTINGS = path.abspath(path.join(WORKING_DIRECTORY, "mo_oauth_settings.php"))
BASE_DECREMENTAL = 10


def get_version(file):
    f = open(file)
    string = f.read()
    matched_lines = [line for line in string.split('\n') if "VERSION" in line]
    f.close()
    if len(matched_lines) > 1:
        return false
    return matched_lines[0].split(',')[1].split('\'')[1].split('_')[1].upper();


def write_version(file):
    f = open(file)
    string = f.read()
    matched_lines = [line for line in string.split('\n') if "Version" in line]
    f.close()
    version = matched_lines[0].split("Version")[1].split(": ")[1].split(".")
    old_version = ''
    for y in version:
        old_version = old_version + y + '.'

    new_version = ''
    for x in compute_version(version):
        new_version = new_version + x + "."



    new_version = new_version[:-1]
    old_version = old_version[:-1]
    print("Old Version: " + old_version)
    print("New Version: " + new_version)
    f = open(file, "w")
    f.write(string.replace(old_version, new_version))
    f.close()
    return new_version


def compute_version(current_version):
    version_to_compute = get_version(AUTOLOAD)
    decremental = BASE_DECREMENTAL
    if version_to_compute == "ENTERPRISE":
        decremental = 0
    if version_to_compute == "PREMIUM":
        decremental = BASE_DECREMENTAL * 1
    if version_to_compute == "STANDARD":
        decremental = BASE_DECREMENTAL * 2
    if version_to_compute == "FREE":
        decremental = BASE_DECREMENTAL * 3

    current_version[0] = str(int(current_version[0]) - decremental)
    return current_version


def manage_dirs():
    if not os.path.exists(WORKING_DIRECTORY):
        os.makedirs(WORKING_DIRECTORY)
        print("Directory " + WORKING_DIRECTORY + " Created ")
    else:
        print("Directory " + WORKING_DIRECTORY +  " already exists")

    print("Removing entire build dir...")
    delete_files_from(WORKING_DIRECTORY)


def delete_files_from(folder_path):
    for file_object in os.listdir(folder_path):
        file_object_path = os.path.join(folder_path, file_object)
        if os.path.isfile(file_object_path):
            os.remove(file_object_path)
        else:
            shutil.rmtree(file_object_path)

def copy_files():
    print("Copying files...")
    copy_tree(path.abspath(path.join(ORIGINAL_DIRECTORY, "classes")), path.abspath(path.join(WORKING_DIRECTORY, "classes")))
    copy_tree(path.abspath(path.join(ORIGINAL_DIRECTORY, "resources")), path.abspath(path.join(WORKING_DIRECTORY, "resources")))
    shutil.copy(path.abspath(path.join(ORIGINAL_DIRECTORY, "mo_oauth_settings.php")), WORKING_DIRECTORY)
    shutil.copy(path.abspath(path.join(ORIGINAL_DIRECTORY, "_autoload.php")), WORKING_DIRECTORY)

def generate_version():
    basepath = path.abspath(path.join(WORKING_DIRECTORY, "classes"))
    version = get_version(AUTOLOAD)
    if version == "PREMIUM":
        delete_files_from(path.abspath(path.join(basepath, "Enterprise")))
    if version == "STANDARD":
        delete_files_from(path.abspath(path.join(basepath, "Enterprise")))
        delete_files_from(path.abspath(path.join(basepath, "Premium")))
    if version == "FREE":
        delete_files_from(path.abspath(path.join(basepath, "Enterprise")))
        delete_files_from(path.abspath(path.join(basepath, "Premium")))
        delete_files_from(path.abspath(path.join(basepath, "Standard")))

def prepare_plugin(new_version):
    output_filename = 'mo_oauth_client_' + new_version
    shutil.make_archive(output_filename, 'zip', path.abspath(path.join(WORKING_DIRECTORY, "..")))
    print("Archive Successfully created at: " + path.abspath(path.join(WORKING_DIRECTORY, output_filename + ".zip")))

manage_dirs()
copy_files()
generate_version()
new_version = write_version(path.abspath(path.join(WORKING_DIRECTORY, "mo_oauth_settings.php")))
zipfile = prepare_plugin(new_version)
