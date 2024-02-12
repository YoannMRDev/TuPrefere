using Backend_TuPreferes.DataBase;
using MySqlX.XDevAPI.Common;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Diagnostics;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Backend_TuPreferes
{
    public partial class frmAjouterDilemme : Form
    {
        List<string[]> categories;

        public frmAjouterDilemme(FunctionDB functionDB)
        {
            InitializeComponent();
            categories = functionDB.GetAllCategory();
            foreach (string[] row in categories)
            {
                cmbCategorie.Items.Add(row[1]);
            }

            cmbCategorie.SelectedItem = cmbCategorie.Items[0];
        }

        public frmAjouterDilemme(FunctionDB functionDB, List<string[]> data) : this(functionDB)
        {
            tbxChoix1.Text = data[0][1];
            tbxChoix2.Text = data[0][2];
            // Récupère l'index de la catégorie
            int index = cmbCategorie.Items.IndexOf(functionDB.GetNomCategoryById(Convert.ToInt32(data[0][4])));
            cmbCategorie.SelectedItem = cmbCategorie.Items[index];
            cbxArchiver.Enabled = true;
            cbxArchiver.Visible = true;
            cbxArchiver.Checked = Convert.ToBoolean(data[0][3]);
        }

        /// <summary>
        /// Retourne le premier choix
        /// </summary>
        public string GetChoix1()
        {
            return tbxChoix1.Text;
        }

        /// <summary>
        /// Retourne le deuxième choix
        /// </summary>
        public string GetChoix2()
        {
            return tbxChoix2.Text;
        }

        /// <summary>
        /// Retourne la catégorie
        /// </summary>
        public string GetCategorie()
        {
            return cmbCategorie.Text;
        }

        /// <summary>
        /// Retourne si la question est archivé
        /// </summary>
        public int GetArchiver()
        {
            return cbxArchiver.Checked ? 1 : 0;
        }

        public void EnabledButtonAdd(object sender, EventArgs e)
        {
            btnAjouter.Enabled = tbxChoix1.Text != "" && tbxChoix2.Text != "" && cmbCategorie.Text != "";
        }
    }
}
